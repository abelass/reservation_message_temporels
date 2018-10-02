<?php
/**
 * Tâche cron du plugin Réservation rappels
 *
 * @plugin     Réservation rappels
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Reservation_rappels\Cron
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function genie_reservation_envoi_rappels_dist($t){


	// Purge des cartes postales agees de 30 jours
	include_spip('inc/invalideur');
	purger_repertoire(_DIR_IMG . 'cartes_postales/', array(
		'atime' => (time() - (30 * 24 * 3600)),
	));
	return 1;
}