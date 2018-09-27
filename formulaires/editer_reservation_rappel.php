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

function formulaires_editer_reservation_rappel_saisies_dist() {
	include_spip('inc/config');
	include_spip('inc/plugin');
	include_spip('inc/reservation_evenements');

	$liste_objets = lister_tables_objets_sql();
	$statuts = array();
	$statuts_selectionnees = array();
	$config = lire_config('reservation_evenement', array());
	$quand = isset($config['quand']) ? $config['quand'] : array();
	$saisies_espace_prives= array();

	// Les objets à afficher dans le panneau config.
	$objets_configuration = re_objets_configuration();

	// Si il y a d'autres panneau que celui du présent plugin.
	if (count($objets_configuration) > 1) {
		$configuration = array();
		foreach ($objets_configuration AS $objet => $valeur) {
			if ($objet != 'reservation_evenement') {
				$configuration[$objet] = $valeur['label'];
			}
		}
		$saisies_espace_prives[] = array(
			'saisie' => 'oui_non',
			'options' => array(
				'nom' => 'selection_objets_configuration',
				'label' => _T('reservation:label_selection_objets_configuration'),
				'explication' => _T('reservation:selection_objets_configuration_explication'),
				'defaut' => $config['selection_objets_configuration']
			)
		);
		$saisies_espace_prives[] = array(
			'saisie' => 'checkbox',
			'options' => array(
				'nom' => 'objets_configuration',
				'datas' => $configuration,
				'label' => _T('reservation:label_objets_configuration'),
				'defaut' => $config['objets_configuration'],
				'afficher_si' => '@selection_objets_configuration@ == "on"',
			)
		);
	}


	// Les objets à afficher dans le menu de navigation.
	$objets_navigation= re_objets_navigation();
	$fieldset_espace_prive = array();

	// Si il y a des menus à choisir.
	if (count($objets_navigation) > 1) {
		$navigation = array();
		foreach ($objets_navigation AS $objet => $valeur) {
			$navigation[$objet] = $valeur['label'];
		}
		$saisies_espace_prives[] = array(
			'saisie' => 'oui_non',
			'options' => array(
				'nom' => 'selection_objets_navigation',
				'label' => _T('reservation:label_selection_objets_navigation'),
				'explication' => _T('reservation:selection_objets_configuration_explication'),
				'defaut' => $config['selection_objets_navigation']
			)
		);
		$saisies_espace_prives[] = array(
			'saisie' => 'checkbox',
			'options' => array(
				'nom' => 'objets_navigation',
				'datas' => $navigation,
				'label' => _T('reservation:label_objets_navigation'),
				'defaut' => $config['objets_navigation'],
				'afficher_si' => '@selection_objets_navigation@ == "on"',
			)
		);
	}

	// Le fieldset espace privé.
	if (count($saisies_espace_prives) > 0) {
		$fieldset_espace_prive = array(
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => 'fieldset_parametres',
				'label' => _T('public:espace_prive')
			),
			'saisies' => $saisies_espace_prives,
		);
	}

	//Le statuts du plugin, sauf en cours
	foreach ($liste_objets['spip_reservations']['statut_textes_instituer'] AS $statut => $label) {
		$statuts[$statut] = _T($label);
		if (in_array($statut, $quand))
			$statuts_selectionnees[$statut] = _T($label);
	}

	if (!test_plugin_actif('corbeille')) {
		$poubelle_duree = array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'duree_vie_poubelle',
				'label' => _T('reservation:label_duree_vie_poubelle'),
				'explication' => _T('reservation:duree_vie_explication',
					array(
						'statut_defaut' => $statuts['poubelle']
					)
					),
				'defaut' => $config['duree_vie_poubelle'],
			)
		);
	}
	else {
		$poubelle_duree = array();
	}


	$choix_expediteurs = array(
		'webmaster' => _T('reservation:notifications_expediteur_choix_webmaster'),
		'administrateur' => _T('reservation:notifications_expediteur_choix_administrateur'),
		'email' => _T('reservation:notifications_expediteur_choix_email')
	);

	if (defined('_DIR_PLUGIN_FACTEUR')) {
		$choix_expediteurs['facteur'] = _T('reservation:notifications_expediteur_choix_facteur');
	}

	return [
		[
			'saisie' => 'fieldset',
			'options' => [
				'nom' => 'fieldset_parametres',
			],
			'saisies' =>  [
				[
					'saisie' => 'input',
					'options' => [
						'nom' => 'titre',
						'obligatoire' => 'oui',
						'label' => _T('reservation_rappel:champ_titre_label'),
					],
				],
				[
					'saisie' => 'textarea',
					'options' => [
						'nom' => 'descriptif',
						'label' => _T('reservation_rappel:champ_descriptif_label'),
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
					'saisie' => 'input',
					'options' => [
						'nom' => 'frequence_cron',
						'label' => _T('reservation_rappel:champ_frequence_cron_label'),
						'explication' => _T('reservation_rappel:champ_frequence_cron_explication'),
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
