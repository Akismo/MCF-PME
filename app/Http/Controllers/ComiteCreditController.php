<?php

namespace App\Http\Controllers;

use App\Models\DemandeCredit;
use App\Models\DocumentDemande;
use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComiteCreditController extends Controller
{
    public function dashboard(Request $request)
    {
        // Statistiques globales
        $stats = [
            'total' => DemandeCredit::count(),
            'en_attente' => DemandeCredit::where('statut', 'En vérification')->count(),
            'approuves' => DemandeCredit::where('statut', 'Approuvée')->count(),
            'refuses' => DemandeCredit::where('statut', 'Refusée')->count(),
            'montant_total' => DemandeCredit::where('statut', 'Approuvée')->sum('montant')
        ];
    
        // Analyse par type de crédit
        $byType = DemandeCredit::select('type_credit', DB::raw('count(*) as total'))
            ->groupBy('type_credit')
            ->get();
    
        // Historique des décisions
        $decisions = DemandeCredit::with('membre')
            ->whereIn('statut', ['Approuvée', 'Refusée'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
    
        // Filtres
        $query = DemandeCredit::with('client')->where('statut', 'En vérification');
    
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
    
        if ($request->filled('type_credit')) {
            $query->where('type_credit', $request->type_credit);
        }
    
        $enAttente = $query->orderBy('date_analyse_caf', 'desc')->paginate(10)->appends($request->all());
    
        $chartColors = [
            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
            '#858796', '#5a5c69', '#2e59d9', '#17a673', '#2c9faf'
        ];
    
        return view('comite-credit.dashboard', compact('stats', 'byType', 'decisions', 'chartColors', 'enAttente'));
    }
    

    private function getRiskColor($score)
    {
        if ($score <= 3)
            return 'success';      // vert
        elseif ($score <= 6)
            return 'warning';  // jaune
        else
            return 'danger';                   // rouge
    }


    public function index()
    {
        $demandes = DemandeCredit::with(['membre', 'documents', 'annotations'])
            ->where('statut', 'En vérification')
            ->orderBy('date_demande', 'desc')
            ->paginate(10);

        // Ajouter le score de risque à chaque demande
        foreach ($demandes as $demande) {
            $demande->risk_score = $this->calculateRiskScore($demande);
            $demande->risk_color = $this->getRiskColor($demande->risk_score);
        }

        return view('comite-credit.index', compact('demandes'));
    }

    private function getRiskLevel($niveau)
    {
        switch ($niveau) {
            case 'Faible':
                return '🟢 Faible';
            case 'Moyen':
                return '🟡 Moyen';
            case 'Élevé':
                return '🔴 Élevé';
            default:
                return '⚪️ Inconnu';
        }
    }


    public function show(DemandeCredit $demande)
    {

        
        $riskScore = $this->calculateRiskScore($demande);
        $riskColor = $this->getRiskColor($riskScore);

        $requiredDocuments = $this->getRequiredDocuments($demande->type_credit);
        $missingDocuments = $this->getMissingDocuments($demande, $requiredDocuments);

        // Calcul des niveaux de risque individuels
        $montantRisk = $this->getRiskLevel($demande->montant > 5000000 ? 'Élevé' : ($demande->montant > 1000000 ? 'Moyen' : 'Faible'));
        $ancienneteRisk = $this->getRiskLevel($demande->membre->date_inscription->diffInMonths(now()) < 6 ? 'Élevé' : ($demande->membre->date_inscription->diffInMonths(now()) < 12 ? 'Moyen' : 'Faible'));
        $documentsRisk = $this->getRiskLevel(count($missingDocuments) > 2 ? 'Élevé' : (count($missingDocuments) > 0 ? 'Moyen' : 'Faible'));

        return view('comite-credit.show', compact(
            'demande',
            'riskScore',
            'riskColor',
            'requiredDocuments',
            'missingDocuments',
            'montantRisk',
            'ancienneteRisk',
            'documentsRisk'
        ));
    }


    public function annotate(Request $request, DemandeCredit $demande)
    {
        $request->validate([
            'contenu' => 'required|string',
            'is_important' => 'nullable|boolean'
        ]);

        // Récupération de l'utilisateur connecté selon les guards
        $user = auth('administrateur')->user() ?? auth('membre')->user();

        if (!$user) {
            return redirect()->back()->withErrors(['auth' => 'Utilisateur non authentifié.']);
        }

        $demande->annotations()->create([
            'demande_credit_id' => $demande->id,
            'user_id' => $user->id,
            'contenu' => $request->contenu,
            'is_important' => $request->is_important ?? false
        ]);

        return back()->with('success', 'Annotation ajoutée avec succès');
    }

    public function decide(Request $request, DemandeCredit $demande)
    {
        $request->validate([
            'decision' => 'required|in:Approuvée,Refusée',
            'commentaire' => 'nullable|required_if:decision,Refusée|string'
        ]);

        $demande->update([
            'statut' => $request->decision,
            'commentaires' => $request->commentaire ?? null
        ]);

        return redirect()->route('comite-credit.index')
            ->with('success', 'Décision enregistrée avec succès');
    }

    private function calculateRiskScore($demande)
    {
        $score = 0;

        // Facteur: Montant du crédit
        if ($demande->montant > 5000000)
            $score += 3;
        elseif ($demande->montant > 1000000)
            $score += 2;
        else
            $score += 1;

        // Facteur: Ancienneté du membre
        $memberSince = $demande->membre->date_inscription->diffInMonths(now());
        if ($memberSince < 6)
            $score += 3;
        elseif ($memberSince < 12)
            $score += 2;
        else
            $score += 1;

        // Facteur: Documents manquants
        $requiredDocs = $this->getRequiredDocuments($demande->type_credit);
        $missingDocs = $this->getMissingDocuments($demande, $requiredDocs);
        $score += count($missingDocs);

        // Échelle de 1 à 10
        return min(10, max(1, $score));
    }

    private function getRequiredDocuments($typeCredit)
    {
        // Définir les documents requis par type de crédit
        $requirements = [
            'Ligne de crédit' => [
                "Document de présentation de l'entreprise (activités, produits, moyens techniques, clients, fournisseurs, effectifs)",
                "État financier de la dernière année",
                "Compte d'exploitation prévisionnel",
                "Tableau de trésorerie sur 12 mois",
                "Relevés bancaires sur 12 mois",
                "Historique des contrats (factures, bons de commande, PV de livraison, réalisation des travaux)",
                "Photos du siège social (si mutualiste)"
            ],
            'Avance sur facture' => [
                "Justificatifs des entrées futures de fonds",
                "Photocopie de la facture réceptionnée (original à présenter)",
                "Photocopie du bon de commande/marché (original à présenter)",
                "Bon de livraison ou attestation d’effectivité de la prestation"
            ],
            'Bon de commande' => [
                "Photocopie du marché ou bon de commande (original à présenter)",
                "Plan de décaissement",
                "Factures pro-forma des fournisseurs",
                "État financier",
                "Compte d'exploitation prévisionnel",
                "Tableau de trésorerie sur 12 mois"
            ],
            'Fonds de roulement' => [
                "Document de présentation de l'entreprise (avec cycle d'exploitation)",
                "Justificatifs des entrées futures de fonds",
                "Compte d'exploitation prévisionnel",
                "Plan de trésorerie sur 12 mois",
                "Dernier état financier",
                "Copie du registre ou cahier de vente / reçus",
                "Certificat de résidence ou contrat de bail"
            ],
            'AGR' => [
                "Relevés bancaires sur 12 mois (facultatif)",
                "Copie du registre de vente ou reçus (facultatif)",
                "Certificat de résidence ou contrat de bail",
                "Facture CIE/SODECI"
            ]
        ];

        return $requirements[$typeCredit] ?? [];
    }

    private function getMissingDocuments($demande, $requiredDocuments)
    {
        $mappings = $this->getDocumentMappings();
        $submittedDocs = $demande->documents->pluck('type_document')->toArray();

        $missing = [];

        foreach ($requiredDocuments as $label) {
            $type = $mappings[$label] ?? null;
            if ($type && !in_array($type, $submittedDocs)) {
                $missing[] = $label;
            }
        }

        return $missing;
    }


    private function getDocumentMappings()
    {
        return [
            "Document de présentation de l'entreprise (activités, produits, moyens techniques, clients, fournisseurs, effectifs)" => "doc_presentation_entreprise",
            "État financier de la dernière année" => "etat_financier_annee",
            "Compte d'exploitation prévisionnel" => "compte_exploitation_previsionnel",
            "Tableau de trésorerie sur 12 mois" => "tableau_tresorerie_12_mois",
            "Relevés bancaires sur 12 mois (facultatif)" => "releves_bancaires_12_mois",
            "Historique des contrats (factures, bons de commande, PV de livraison, réalisation des travaux)" => "historique_contrats",
            "Photos du siège social (si mutualiste)" => "photos_siege_social",
            "Justificatifs des entrées futures de fonds" => "justificatifs_entrees_fonds",
            "Photocopie de la facture réceptionnée (original à présenter)" => "facture_receptionnee",
            "Photocopie du bon de commande/marché (original à présenter)" => "bon_commande_marche",
            "Bon de livraison ou attestation d’effectivité de la prestation" => "bon_livraison_attestation",
            "Photocopie du marché ou bon de commande (original à présenter)" => "marche_bon_commande",
            "Plan de décaissement" => "plan_decaissement",
            "Factures pro-forma des fournisseurs" => "factures_proforma_fournisseurs",
            "État financier" => "etat_financier",
            "Plan de trésorerie sur 12 mois" => "plan_tresorerie_12_mois",
            "Document de présentation de l'entreprise (avec cycle d'exploitation)" => "doc_presentation_cycle",
            "Dernier état financier" => "dernier_etat_financier",
            "Copie du registre ou cahier de vente / reçus" => "registre_vente_recus",
            "Certificat de résidence ou contrat de bail" => "certificat_residence_bail",
            "Copie du registre de vente ou reçus (facultatif)" => "registre_vente_recus_facultatif",
            "Facture CIE/SODECI" => "facture_cie_sodeci",
        ];
    }


}