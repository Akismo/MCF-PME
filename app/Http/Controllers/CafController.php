<?php

namespace App\Http\Controllers;

use App\Models\DemandeCredit;
use App\Models\DocumentDemande;
use Illuminate\Http\Request;

class CafController extends Controller
{

    public function dashboard(Request $request)
    {
        // Filtres
        $query = DemandeCredit::query();
    
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
    
        if ($request->filled('type_credit')) {
            $query->where('type_credit', $request->type_credit);
        }
    
        // Statistiques
        $totalDemandes = DemandeCredit::count();
        $enAttente = DemandeCredit::where('statut', 'En attente')->count();
        $enVerification = DemandeCredit::where('statut', 'En vérification')->count();
    
        // Liste paginée
        $demandes = $query->with(['membre'])->orderBy('date_demande', 'desc')->paginate(10);
    
        // Liste des types de crédit distincts pour les filtres
        $typesCredits = DemandeCredit::select('type_credit')->distinct()->pluck('type_credit');
    
        return view('caf.dashboard', compact(
            'totalDemandes',
            'enAttente',
            'enVerification',
            'demandes',
            'typesCredits'
        ));
    }
    
    public function index()
    {
        $demandes = DemandeCredit::with(['membre', 'documents'])
            ->whereIn('statut', ['En attente', 'En vérification'])
            ->orderBy('date_demande', 'desc')
            ->paginate(10);

        return view('caf.index', compact('demandes'));
    }

    public function show(DemandeCredit $demande)
    {
        $requiredDocuments = $this->getRequiredDocuments($demande->type_credit);
        $missingDocuments = $this->getMissingDocuments($demande, $requiredDocuments);

        return view('caf.show', compact('demande', 'requiredDocuments', 'missingDocuments'));
    }

    public function verify(Request $request, DemandeCredit $demande)
    {
        $request->validate([
            'statut' => 'required|in:En vérification,Documents incomplets',
            'commentaires' => 'nullable|required_if:statut,Documents incomplets|string'
        ]);

        $commentaires = $request->statut === 'Documents incomplets' ? $request->commentaires : null;


        $demande->update([
            'statut' => $request->statut,
            'commentaires' => $commentaires,
        ]);

        return redirect()->route('caf.index')
            ->with('success', 'Demande mise à jour avec succès');
    }

    public function filter(Request $request)
    {
        $query = DemandeCredit::with(['membre', 'documents'])
            ->orderBy('date_demande', 'desc');

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('type_credit')) {
            $query->where('type_credit', $request->type_credit);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('membre', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('prenom', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $demandes = $query->paginate(10);

        return view('caf.index', compact('demandes'));
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


    private function getDocumentTypesLabels()
    {
        return [
            'releves_bancaires_12m' => 'Relevés bancaires sur 12 mois (facultatif)',
            'registre_vente_recus_facultatif' => 'Copie du registre de vente ou reçus (facultatif)',
            'certificat_residence_bail' => 'Certificat de résidence ou contrat de bail',
            'facture_cie_sodeci' => 'Facture CIE/SODECI',
            'document_inconnu' => 'Document inconnu',
            // Ajoute ici tous les autres types pour les autres crédits
        ];
    }

}
