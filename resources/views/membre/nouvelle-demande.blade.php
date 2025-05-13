@extends('membre.app')

@section('title', 'Nouvelle demande de crédit')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nouvelle demande de crédit</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('membre_soumettre_demande') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="form-group">
                        <label for="type_credit">Type de crédit</label>
                        <select class="form-control" id="type_credit" name="type_credit" required>
                            <option value="">Sélectionnez un type</option>
                            @foreach($typesCredit as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="documents-requirements" class="mb-4">
                        <!-- Contenu dynamique basé sur le type de crédit -->
                    </div>

                    <div class="form-group">
                        <label for="montant">Montant demandé (FCFA)</label>
                        <input type="number" class="form-control" id="montant" name="montant" min="100" step="100" required>
                    </div>

                    <div class="form-group">
                        <label for="duree">Durée de remboursement</label>
                        <input type="text" class="form-control" id="duree" name="duree" placeholder="Ex: 12 mois" required>
                    </div>

                    <div class="form-group">
                        <label for="description_projet">Description du projet</label>
                        <textarea class="form-control" id="description_projet" name="description_projet" rows="4"
                            required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="font-weight-bold">Documents à lire, remplir et joindre :</label>
                        <ul>
                            <li><a href="{{ asset('documents/MODELE DE LETTRE DE DEMANDE DE CREDIT.pdf') }}"
                                    target="_blank">📄 Modèle de lettre de demande de crédit</a></li>
                            <li><a href="{{ asset('documents/ENGAGEMENTS ET CONSENTEMENTS DE DEMANDE DE CREDIT.pdf') }}"
                                    target="_blank">📄 Engagements et consentements</a></li>
                            <li><a href="{{ asset('documents/FOMULAIRE DE DEMANDE DE CREDIT.pdf') }}" target="_blank">📄
                                    Formulaire de demande de credit</a></li>
                        </ul>
                        <small class="text-muted">Téléchargez, signez et joignez ces documents dans la section
                            ci-dessous.</small>
                    </div>


                    <div class="form-group">
                        <label>Documents à fournir</label>
                        <div id="file-inputs-container">
                            <div class="input-group mb-2">
                                <input type="file" name="documents[]" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger remove-doc" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-document">
                            <i class="fas fa-plus"></i> Ajouter un document
                        </button>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Soumettre la demande
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const creditTypeSelect = document.getElementById('type_credit');
            const documentsRequirements = document.getElementById('documents-requirements');

            // Exigences documentaires par type de crédit
            const requirements = {
                'Ligne de crédit': [
                    "Document de présentation de l'entreprise (activités, produits, moyens techniques, clients, fournisseurs, effectifs)",
                    "État financier de la dernière année",
                    "Compte d'exploitation prévisionnel",
                    "Tableau de trésorerie sur 12 mois",
                    "Relevés bancaires sur 12 mois",
                    "Historique des contrats (factures, bons de commande, PV de livraison, réalisation des travaux)",
                    "Photos du siège social (si mutualiste)"
                ],
                'Avance sur facture': [
                    "Justificatifs des entrées futures de fonds",
                    "Photocopie de la facture réceptionnée (original à présenter)",
                    "Photocopie du bon de commande/marché (original à présenter)",
                    "Bon de livraison ou attestation d’effectivité de la prestation"
                ],
                'Bon de commande': [
                    "Photocopie du marché ou bon de commande (original à présenter)",
                    "Plan de décaissement",
                    "Factures pro-forma des fournisseurs",
                    "État financier",
                    "Compte d'exploitation prévisionnel",
                    "Tableau de trésorerie sur 12 mois"
                ],
                'Fonds de roulement': [
                    "Document de présentation de l'entreprise (avec cycle d'exploitation)",
                    "Justificatifs des entrées futures de fonds",
                    "Compte d'exploitation prévisionnel",
                    "Plan de trésorerie sur 12 mois",
                    "Dernier état financier",
                    "Copie du registre ou cahier de vente / reçus",
                    "Certificat de résidence ou contrat de bail"
                ],
                'AGR': [
                    "Relevés bancaires sur 12 mois (facultatif)",
                    "Copie du registre de vente ou reçus (facultatif)",
                    "Certificat de résidence ou contrat de bail",
                    "Facture CIE/SODECI"
                ]

            };

            const documentSlugs = {
                "Document de présentation de l'entreprise (activités, produits, moyens techniques, clients, fournisseurs, effectifs)": "doc_presentation_entreprise",
                "État financier de la dernière année": "etat_financier_annee",
                "Compte d'exploitation prévisionnel": "compte_exploitation_previsionnel",
                "Tableau de trésorerie sur 12 mois": "tableau_tresorerie_12_mois",
                "Relevés bancaires sur 12 mois": "releves_bancaires_12_mois",
                "Historique des contrats (factures, bons de commande, PV de livraison, réalisation des travaux)": "historique_contrats",
                "Photos du siège social (si mutualiste)": "photos_siege_social",
                "Justificatifs des entrées futures de fonds": "justificatifs_entrees_fonds",
                "Photocopie de la facture réceptionnée (original à présenter)": "facture_receptionnee",
                "Photocopie du bon de commande/marché (original à présenter)": "bon_commande_marche",
                "Bon de livraison ou attestation d’effectivité de la prestation": "bon_livraison_attestation",
                "Photocopie du marché ou bon de commande (original à présenter)": "marche_bon_commande",
                "Plan de décaissement": "plan_decaissement",
                "Factures pro-forma des fournisseurs": "factures_proforma_fournisseurs",
                "État financier": "etat_financier",
                "Plan de trésorerie sur 12 mois": "plan_tresorerie_12_mois",
                "Document de présentation de l'entreprise (avec cycle d'exploitation)": "doc_presentation_cycle",
                "Dernier état financier": "dernier_etat_financier",
                "Copie du registre ou cahier de vente / reçus": "registre_vente_recus",
                "Certificat de résidence ou contrat de bail": "certificat_residence_bail",
                "Copie du registre de vente ou reçus (facultatif)": "registre_vente_recus_facultatif",
                "Facture CIE/SODECI": "facture_cie_sodeci"
            };

            // Gestion de l'ajout/suppression de champs de documents
            document.getElementById('add-document').addEventListener('click', function () {
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                                <input type="file" name="documents[]" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger remove-doc" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `;
                document.getElementById('file-inputs-container').appendChild(div);
            });

            document.getElementById('file-inputs-container').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-doc')) {
                    e.target.closest('.input-group').remove();
                }
            });

            creditTypeSelect.addEventListener('change', function () {
                const selectedType = this.value;
                const container = document.getElementById('file-inputs-container');
                container.innerHTML = ''; // Reset

                if (selectedType && requirements[selectedType]) {
                    let html = '<div class="alert alert-info"><h5>Documents requis:</h5><ul>';
                    requirements[selectedType].forEach(req => {
                        const slug = documentSlugs[req] || 'document_inconnu';
                        html += `<li>${req}</li>`;
                        container.innerHTML += `
                    <div class="input-group mb-2">
                        <input type="file" name="documents[${slug}]" class="form-control" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger remove-doc" type="button">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;
                    });
                    html += '</ul></div>';
                    documentsRequirements.innerHTML = html;
                } else {
                    documentsRequirements.innerHTML = '';
                }
            });




        });
    </script>
@endsection