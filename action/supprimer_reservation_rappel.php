<?php
/**
 * Utilisation de l'action supprimer pour l'objet reservation_rappel
 *
 * @plugin     Réservation rappels
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Reservation_rappels\Action
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



/**
 * Action pour supprimer un·e reservation_rappel
 *
 * Vérifier l'autorisation avant d'appeler l'action.
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, reservation_rappel, #ID_RESERVATION_RAPPEL}|oui)
 *         [(#BOUTON_ACTION{<:reservation_rappel:supprimer_reservation_rappel:>,
 *             #URL_ACTION_AUTEUR{supprimer_reservation_rappel, #ID_RESERVATION_RAPPEL, #URL_ECRIRE{reservation_rappels}},
 *             danger, <:reservation_rappel:confirmer_supprimer_reservation_rappel:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, reservation_rappel, #ID_RESERVATION_RAPPEL}|oui)
 *         [(#BOUTON_ACTION{
 *             [(#CHEMIN_IMAGE{reservation_rappel-del-24.png}|balise_img{<:reservation_rappel:supprimer_reservation_rappel:>}|concat{' ',#VAL{<:reservation_rappel:supprimer_reservation_rappel:>}|wrap{<b>}}|trim)],
 *             #URL_ACTION_AUTEUR{supprimer_reservation_rappel, #ID_RESERVATION_RAPPEL, #URL_ECRIRE{reservation_rappels}},
 *             icone s24 horizontale danger reservation_rappel-del-24, <:reservation_rappel:confirmer_supprimer_reservation_rappel:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     if (autoriser('supprimer', 'reservation_rappel', $id_reservation_rappel)) {
 *          $supprimer_reservation_rappel = charger_fonction('supprimer_reservation_rappel', 'action');
 *          $supprimer_reservation_rappel($id_reservation_rappel);
 *     }
 *     ```
 *
 * @param null|int $arg
 *     Identifiant à supprimer.
 *     En absence de id utilise l'argument de l'action sécurisée.
**/
function action_supprimer_reservation_rappel_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$arg = intval($arg);

	// cas suppression
	if ($arg) {
		sql_delete('spip_reservation_rappels',  'id_reservation_rappel=' . sql_quote($arg));
	}
	else {
		spip_log("action_supprimer_reservation_rappel_dist $arg pas compris");
	}
}
