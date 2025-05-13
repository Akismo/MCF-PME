<?php

if (!function_exists('mapDocumentLabelToType')) {
    /**
     * Cette fonction mappe un libellé de document à son type associé dans l'application.
     *
     * @param string $label
     * @return string|null
     */
    function mapDocumentLabelToType(string $label): ?string
    {
        $docMappings = [
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

        return $docMappings[$label] ?? null;
    }
}
