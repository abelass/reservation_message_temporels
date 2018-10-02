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

	$rappels = sql_allfetsel('declencheur_date,declencheur_statut,nombre_jours,id_reservation_rappel', 'spip_reservation_rappels', 'statut LIKE ' .sql_quote('publie'), '', 'rang');
	/*$reservations_details  = sql_allfetsel(
		'id_reservations_detail,id_reservation',
		'spip_reservations_details',
		'statut IN (' .sql_quote('attente_paiement') . ', '  .sql_quote('accepte_part') . ', '  .sql_quote('attente_part') . ')');*/
	foreach ($rappels AS $rappel) {
		$id_reservation_rappel = $rappel['id_reservation_rappel'];
		$reservations_rappelees = sql_allfetsel(
			'id_objet',
			'spip_reservation_rappels_liens',
			'id_reservation_rappel=' . $id_reservation_rappel . ' objet=' . sql_quote('reservation'));
		$id_reservations_rappelees = array_column($reservations_rappelees, 'id_objet');


	}



	return 1;
}