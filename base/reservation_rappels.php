<?php
/**
 * Déclarations relatives à la base de données
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


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function reservation_rappels_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['reservation_rappels'] = 'reservation_rappels';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function reservation_rappels_declarer_tables_objets_sql($tables) {

	$tables['spip_reservation_rappels'] = array(
		'type' => 'reservation_rappel',
		'principale' => 'oui',
		'table_objet_surnoms' => array('reservationrappel'), // table_objet('reservation_rappel') => 'reservation_rappels'
		'field'=> array(
			'id_reservation_rappel' => 'bigint(21) NOT NULL',
			'titre'              => 'varchar(255) NOT NULL DEFAULT ""',
			'descriptif'         => 'text NOT NULL DEFAULT ""',
			'declencheur_date'   => 'varchar(20) NOT NULL DEFAULT ""',
			'declencheur_statut' => 'varchar(25) NOT NULL DEFAULT ""',
			'nombre_jours'       => 'int(11) NOT NULL DEFAULT 0',
			'date'               => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'statut'             => 'varchar(20)  DEFAULT "0" NOT NULL',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_reservation_rappel',
			'KEY statut'         => 'statut',
		),
		'titre' => 'titre AS titre, "" AS lang',
		'date' => 'date',
		'champs_editables'  => array('titre', 'descriptif', 'declencheur_date', 'declencheur_statut', 'nombre_jours'),
		'champs_versionnes' => array('titre', 'descriptif', 'declencheur_date', 'declencheur_statut', 'nombre_jours'),
		'rechercher_champs' => array("titre" => 8, "descriptif" => 5, "declencheur_date" => 5),
		'tables_jointures'  => array('spip_reservation_rappels_liens'),
		'statut_textes_instituer' => array(
			'prepa'    => 'texte_statut_en_cours_redaction',
			'prop'     => 'texte_statut_propose_evaluation',
			'publie'   => 'texte_statut_publie',
			'refuse'   => 'texte_statut_refuse',
			'poubelle' => 'texte_statut_poubelle',
		),
		'statut'=> array(
			array(
				'champ'     => 'statut',
				'publie'    => 'publie',
				'previsu'   => 'publie,prop,prepa',
				'post_date' => 'date',
				'exception' => array('statut','tout')
			)
		),
		'texte_changer_statut' => 'reservation_rappel:texte_changer_statut_reservation_rappel',


	);

	return $tables;
}


/**
 * Déclaration des tables secondaires (liaisons)
 *
 * @pipeline declarer_tables_auxiliaires
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function reservation_rappels_declarer_tables_auxiliaires($tables) {

	$tables['spip_reservation_rappels_liens'] = array(
		'field' => array(
			'id_reservation_rappel' => 'bigint(21) DEFAULT "0" NOT NULL',
			'id_objet'           => 'bigint(21) DEFAULT "0" NOT NULL',
			'objet'              => 'VARCHAR(25) DEFAULT "" NOT NULL',
			'vu'                 => 'VARCHAR(6) DEFAULT "non" NOT NULL',
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_reservation_rappel,id_objet,objet',
			'KEY id_reservation_rappel' => 'id_reservation_rappel',
		)
	);

	return $tables;
}
