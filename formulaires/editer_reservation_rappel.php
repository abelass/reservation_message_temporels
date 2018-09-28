<?php
/**
 * Gestion du formulaire de d'édition de reservation_rappel
 *
 * @plugin     Réservation rappels
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Reservation_rappels\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/actions');
include_spip('inc/editer');

/**
 * Création du formulaire via l'api de spip
 *
 * @return array
 *     Définition des champs.
 */
function formulaires_editer_reservation_rappel_saisies_dist() {
	$liste_objets = lister_tables_objets_sql();
	$statuts = [];

	//Le statuts du plugin réservation.
	foreach ($liste_objets['spip_reservations']['statut_textes_instituer'] AS $statut => $label) {
		$statuts[$statut] = _T($label);
	}

	return [
		[
			'saisie' => 'fieldset',
			'options' => [
				'nom' => 'fieldset_parametres',
			],
			'saisies' => [
				[
					'saisie' => 'input',
					'options' => [
						'nom' => 'titre',
						'obligatoire' => 'oui',
						'label' => _T('info_titre'),
					],
				],
				[
					'saisie' => 'textarea',
					'options' => [
						'nom' => 'descriptif',
						'label' => _T('info_descriptif'),
					],
				],
				[
					'saisie' => 'reservation_rappels',
					'options' => [
						'nom' => 'rappel_precedent',
						'label' => _T('reservation_rappel:champ_rappel_precedent_label'),
						'explication' => _T('reservation_rappel:champ_rappel_precedent_explication'),
						'exclus' => _request('id_reservation_rappel'),
					],
				],
				[
					'saisie' => 'selection',
					'options' => [
						'nom' => 'declencheur_statut',
						'label' => _T('reservation_rappel:champ_declencheur_statut_label'),
						'data' => $statuts,
					],
				],
				[
					'saisie' => 'selection',
					'options' => [
						'nom' => 'declencheur_date',
						'obligatoire' => 'oui',
						'label' => _T('reservation_rappel:champ_declencheur_date_label'),
						'data' => [
							'date_debut_evenement' => _T('reservation_rappel:item_date_debut_evenement'),
							'date_reservation' => _T('reservation_rappel:item_date_reservation'),
						],
					],
				],
				[
					'saisie' => 'input',
					'options' => [
						'nom' => 'nombre_jours',
						'obligatoire' => 'oui',
						'label' => _T('reservation_rappel:champ_nombre_jours_label'),
					],
				],
			],
		],
	];
}

/**
 * Identifier le formulaire en faisant abstraction des paramètres qui ne représentent pas l'objet edité
 *
 * @param int|string $id_reservation_rappel
 *     Identifiant du reservation_rappel. 'new' pour un nouveau reservation_rappel.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_rappel créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_rappel source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_rappel, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return string
 *     Hash du formulaire
 */
function formulaires_editer_reservation_rappel_identifier_dist($id_reservation_rappel = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	return serialize(array(intval($id_reservation_rappel), $associer_objet));
}

/**
 * Chargement du formulaire d'édition de reservation_rappel
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @uses formulaires_editer_objet_charger()
 *
 * @param int|string $id_reservation_rappel
 *     Identifiant du reservation_rappel. 'new' pour un nouveau reservation_rappel.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_rappel créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_rappel source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_rappel, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_reservation_rappel_charger_dist($id_reservation_rappel = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$valeurs = formulaires_editer_objet_charger('reservation_rappel', $id_reservation_rappel, '', $lier_trad, $retour, $config_fonc, $row, $hidden);
	return $valeurs;
}

/**
 * Vérifications du formulaire d'édition de reservation_rappel
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @uses formulaires_editer_objet_verifier()
 *
 * @param int|string $id_reservation_rappel
 *     Identifiant du reservation_rappel. 'new' pour un nouveau reservation_rappel.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_rappel créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_rappel source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_rappel, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_reservation_rappel_verifier_dist($id_reservation_rappel = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$erreurs = array();

	$verifier = charger_fonction('verifier', 'inc');

	foreach (array('date_declenchement') AS $champ) {
		$normaliser = null;
		if ($erreur = $verifier(_request($champ), 'date', array('normaliser'=>'datetime'), $normaliser)) {
			$erreurs[$champ] = $erreur;
		// si une valeur de normalisation a ete transmis, la prendre.
		} elseif (!is_null($normaliser)) {
			set_request($champ, $normaliser);
		// si pas de normalisation ET pas de date soumise, il ne faut pas tenter d'enregistrer ''
		} else {
			set_request($champ, null);
		}
	}

	$erreurs += formulaires_editer_objet_verifier('reservation_rappel', $id_reservation_rappel, array('titre', 'declencheur_date'));

	return $erreurs;
}

/**
 * Traitement du formulaire d'édition de reservation_rappel
 *
 * Traiter les champs postés
 *
 * @uses formulaires_editer_objet_traiter()
 *
 * @param int|string $id_reservation_rappel
 *     Identifiant du reservation_rappel. 'new' pour un nouveau reservation_rappel.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_rappel créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_rappel source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_rappel, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retours des traitements
 */
function formulaires_editer_reservation_rappel_traiter_dist($id_reservation_rappel = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$retours = formulaires_editer_objet_traiter('reservation_rappel', $id_reservation_rappel, '', $lier_trad, $retour, $config_fonc, $row, $hidden);

	// Un lien a prendre en compte ?
	if ($associer_objet and $id_reservation_rappel = $retours['id_reservation_rappel']) {
		list($objet, $id_objet) = explode('|', $associer_objet);

		if ($objet and $id_objet and autoriser('modifier', $objet, $id_objet)) {
			include_spip('action/editer_liens');

			objet_associer(array('reservation_rappel' => $id_reservation_rappel), array($objet => $id_objet));

			if (isset($retours['redirect'])) {
				$retours['redirect'] = parametre_url($retours['redirect'], 'id_lien_ajoute', $id_reservation_rappel, '&');
			}
		}
	}

	return $retours;
}
