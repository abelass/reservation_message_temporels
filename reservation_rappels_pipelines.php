<?php
/**
 * Utilisations de pipelines par Réservation rappels
 *
 * @plugin     Réservation rappels
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Reservation_rappels\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/*
 * Un fichier de pipelines permet de regrouper
 * les fonctions de branchement de votre plugin
 * sur des pipelines existants.
 */



/**
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservation_rappels_affiche_milieu($flux) {
	$texte = '';
	$e = trouver_objet_exec($flux['args']['exec']);



	// reservation_rappels sur les auteurs
	if (!$e['edition'] and in_array($e['type'], array('auteur'))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'reservation_rappels',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}

	if ($texte) {
		if ($p = strpos($flux['data'], '<!--affiche_milieu-->')) {
			$flux['data'] = substr_replace($flux['data'], $texte, $p, 0);
		} else {
			$flux['data'] .= $texte;
		}
	}

	return $flux;
}




/**
 * Optimiser la base de données
 *
 * Supprime les liens orphelins de l'objet vers quelqu'un et de quelqu'un vers l'objet.
 * Supprime les objets à la poubelle.
 *
 * @pipeline optimiser_base_disparus
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservation_rappels_optimiser_base_disparus($flux) {

	include_spip('action/editer_liens');
	$flux['data'] += objet_optimiser_liens(array('reservation_rappel'=>'*'), '*');

	sql_delete('spip_reservation_rappels', "statut='poubelle' AND maj < " . $flux['args']['date']);

	return $flux;
}

/**
 * Déclarer des fonctions exécutées de manière périodique par SPIP
 *
 * @param array $taches
 * @return array
 */
function reservation_rappels_taches_generales_cron($taches){
	$taches['reservation_envoi_rappels'] = RESERVATION_RAPPELS_CRON;
	return $taches;
}
