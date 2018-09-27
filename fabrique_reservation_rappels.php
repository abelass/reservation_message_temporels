<?php

/**
 *  Fichier généré par la Fabrique de plugin v6
 *   le 2018-09-27 14:47:15
 *
 *  Ce fichier de sauvegarde peut servir à recréer
 *  votre plugin avec le plugin «Fabrique» qui a servi à le créer.
 *
 *  Bien évidemment, les modifications apportées ultérieurement
 *  par vos soins dans le code de ce plugin généré
 *  NE SERONT PAS connues du plugin «Fabrique» et ne pourront pas
 *  être recréées par lui !
 *
 *  La «Fabrique» ne pourra que régénerer le code de base du plugin
 *  avec les informations dont il dispose.
 *
**/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$data = array (
  'fabrique' => 
  array (
    'version' => 6,
  ),
  'paquet' => 
  array (
    'prefixe' => 'reservation_rappels',
    'nom' => 'Réservation rappels',
    'slogan' => 'Système de rappels pour vos réservations',
    'description' => 'Permet de gérer un système de messages de rappels envoyé aux personnes inscrits à un événement.',
    'logo' => 
    array (
      0 => '',
    ),
    'version' => '1.0.0',
    'auteur' => 'Rainer Müller',
    'auteur_lien' => 'https://websimple.be',
    'licence' => 'GNU/GPL v3',
    'categorie' => 'communication',
    'etat' => 'dev',
    'compatibilite' => '[3.2.1;3.2.*]',
    'documentation' => 'https://github.com/abelass/reservation_rappels',
    'administrations' => 'on',
    'schema' => '1.0.0',
    'formulaire_config' => '',
    'formulaire_config_titre' => '',
    'fichiers' => 
    array (
      0 => 'autorisations',
      1 => 'fonctions',
      2 => 'pipelines',
    ),
    'inserer' => 
    array (
      'paquet' => '',
      'administrations' => 
      array (
        'maj' => '',
        'desinstallation' => '',
        'fin' => '',
      ),
      'base' => 
      array (
        'tables' => 
        array (
          'fin' => '',
        ),
      ),
    ),
    'scripts' => 
    array (
      'pre_copie' => '',
      'post_creation' => '',
    ),
    'exemples' => 'on',
  ),
  'objets' => 
  array (
    0 => 
    array (
      'nom' => 'Rappels',
      'nom_singulier' => 'Rappel',
      'genre' => 'masculin',
      'logo' => 
      array (
        0 => '',
        32 => '',
        24 => '',
        16 => '',
        12 => '',
      ),
      'logo_variantes' => 'on',
      'table' => 'spip_reservation_rappels',
      'cle_primaire' => 'id_reservation_rappel',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'reservation_rappel',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'Titre',
          'champ' => 'titre',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '8',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'Déscriptif',
          'champ' => 'descriptif',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '5',
          'saisie' => 'textarea',
          'explication' => '',
          'saisie_options' => '',
        ),
        2 => 
        array (
          'nom' => 'Rappel précédent ',
          'champ' => 'rappel_precedent',
          'sql' => 'varchar(50) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => 'reservation_rappels',
          'explication' => 'Ne será envoyé seulement après l\'envoi du rappel précédent',
          'saisie_options' => '',
        ),
        3 => 
        array (
          'nom' => 'Fréquence cron',
          'champ' => 'frequence_cron',
          'sql' => 'int(11) NOT NULL DEFAULT 0',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Fréquence en secondes avec la quelle le système vérifie s\'il faut envoyer un rappel. Défaut 86400 = 1 jour',
          'saisie_options' => '',
        ),
        4 => 
        array (
          'nom' => 'Déclencheur Date',
          'champ' => 'declencheur_date',
          'sql' => 'varchar(20) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '5',
          'saisie' => 'selection',
          'explication' => '',
          'saisie_options' => '',
        ),
        5 => 
        array (
          'nom' => 'Déclencheur statut',
          'champ' => 'declencheur_statut',
          'sql' => 'varchar(25) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => 'selection',
          'explication' => '',
          'saisie_options' => '',
        ),
        6 => 
        array (
          'nom' => 'Date déclenchement',
          'champ' => 'date_declenchement',
          'sql' => 'datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => 'date',
          'explication' => '',
          'saisie_options' => '',
        ),
        7 => 
        array (
          'nom' => 'Nombre de jours',
          'champ' => 'nombre_jours',
          'sql' => 'int(11) NOT NULL DEFAULT 0',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
      ),
      'champ_titre' => 'titre',
      'champ_date' => 'date',
      'statut' => 'on',
      'chaines' => 
      array (
        'titre_objets' => 'Rappels',
        'titre_objet' => 'Rappel',
        'info_aucun_objet' => 'Aucun rappel',
        'info_1_objet' => 'Un rappel',
        'info_nb_objets' => '@nb@ rappels',
        'icone_creer_objet' => 'Créer un rappel',
        'icone_modifier_objet' => 'Modifier ce rappel',
        'titre_logo_objet' => 'Logo de ce rappel',
        'titre_langue_objet' => 'Langue de ce rappel',
        'texte_definir_comme_traduction_objet' => 'Ce rappel est une traduction du rappel numéro :',
        'titre_\\objets_lies_objet' => 'Liés à ce rappel',
        'titre_objets_rubrique' => 'Rappels de la rubrique',
        'info_objets_auteur' => 'Les rappels de cet auteur',
        'retirer_lien_objet' => 'Retirer ce rappel',
        'retirer_tous_liens_objets' => 'Retirer tous les rappels',
        'ajouter_lien_objet' => 'Ajouter ce rappel',
        'texte_ajouter_objet' => 'Ajouter un rappel',
        'texte_creer_associer_objet' => 'Créer et associer un rappel',
        'texte_changer_statut_objet' => 'Ce rappel est :',
        'supprimer_objet' => 'Supprimer cet rappel',
        'confirmer_supprimer_objet' => 'Confirmez-vous la suppression de ce rappel ?',
      ),
      'liaison_directe' => '',
      'table_liens' => 'on',
      'vue_liens' => 
      array (
        0 => 'spip_auteurs',
      ),
      'afficher_liens' => 'on',
      'roles' => '',
      'auteurs_liens' => '',
      'vue_auteurs_liens' => '',
      'fichiers' => 
      array (
        'echafaudages' => 
        array (
          0 => 'prive/squelettes/contenu/objets.html',
          1 => 'prive/objets/infos/objet.html',
          2 => 'prive/squelettes/contenu/objet.html',
        ),
        'explicites' => 
        array (
          0 => 'action/supprimer_objet.php',
        ),
      ),
      'saisies' => 
      array (
        0 => 'objets',
      ),
      'autorisations' => 
      array (
        'objet_creer' => '',
        'objet_voir' => '',
        'objet_modifier' => '',
        'objet_supprimer' => '',
        'associerobjet' => '',
      ),
      'boutons' => 
      array (
        0 => 'menu_edition',
      ),
    ),
  ),
  'images' => 
  array (
    'paquet' => 
    array (
      'logo' => 
      array (
        0 => 
        array (
          'extension' => 'png',
          'contenu' => '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',
        ),
      ),
    ),
    'objets' => 
    array (
      0 => 
      array (
        'logo' => 
        array (
          0 => 
          array (
            'extension' => 'png',
            'contenu' => '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UoexHz/60Y/MMccck/UmM1rIPprHaN9rxowZ5jvf+Q4XuMN43HDDDWbmzJmHbCkdT31yw2EsFjPt7e3mhhtuoEaH8fjud79rOjs7jSQTj8cPe0LDeB9dXV3mJz/5CTU6xGPz5s3mb//2b01ra+uYY94m+hGJRExLS4t54oknqFEeHzbzdvPn5z//uXbt2pVZg+egtV+s8c/SDqbzh2ch79mzR8uXL9dDDz3UQBXGduedd2rr1q2yLCtrWRFJWUtVjGdWeLhOQc1Xr16thx9+WE8++STr/4zhjTfeML/+9a+1atUqSVIymZRlWXIcR7ZtT1h9cg0PD6uvr0933nmn1q5dS43G8NRTT5nf//732rx5c7DEkizLOujalA979uzRz372M4pwCPPmzdPLL7+s3t5eOY4jx3EKUp9UKqXt27frjjvuoAh5RJDLk/nz55v77rsvsx5SeI2kfC0jE0gmk1q+fLl++9vfKplMnk01Rvb73//eLFy4UIODg1mhIDd0TWR9XNeV53mSpDVr1ui2226jEGO4//77tWnTJsViMUUiEUn7F45Np9MHrXE1kTdFvu+rv79fb731lu666y4KMYbbbrtNy5cvz7pBDW6G8q2vr08vvviiHnzwQcL2KLZs2WLuuusurVixQqlUSsaYCT93DnVO3XvvvXr00UepUb7QLJmf9eJmz56dNSA7d/yHJrCbNTz2J/wzpkyZYu655x6atEdZL+688847aCC2xhj/djSPoLt2pDXmPM8zVVVVZvny5dRohMe6detMXV3dqK/3iepaHev7WJZl4vG4Wb16NTUa4bFy5UoTjUazxkuFJzsU4mFZljn33HOpzyiPu+66y7S3t484qaQQ9QmGQ/z93/+92bJlC3Wia7U09Pb2XrNgwYJM87UxRr7v560pO7flyLIsWZal3bt363e/+x0FGcGqVatOW7BgQWZ3BmOMPM+T4ziZ1tOJqNdId77B54Lt2J555hkKMoLly5dr37598jxPtm1nWrSDWk3ErjTGmMz5Ej5/gp0gbNtWMpnU2rVrKcgIHnvsMSWTyUwLqeu6mR02gnOpEI0Rzz//vObPn0+Lzwjmzp2rgYGBzPUseG0XqlUu+DkLFy5Uf38/BckDglwevPDCC9q8efOIQSD8pjFR26OFv08QHCVpYGBAzz33HAUZwaJFi7R3796DutOCi85E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g0cpPWzbzvwZzjbB513XNaeffrqZP3++yVfeysus1T179tx94YUXXrxw4UINDw8rEoloeHhYUvZ+ZezcAAAASlU40ziOk9leNPy1mpoanXzyyXrmmWfyMp5swvs2h4aGZt90000XL1y4MNOVGoS43I+D9VgAAABKTTqdznSxhnemejsPSdo/hm7ZsmX69re/bXzfn170QW7OnDk/veOOO5RKpdTf35/5pTzPy6yE7DiOHMfJDBAEAAAoJZZlKZVKZfZkDcJc8DVp/1yAwcFB9fX16a677tLDDz+8uqiD3JYtW8zcuXO1fv36gxb7TSaTmY/T6XTWdlwAAAClJJxzcoeJhfdoDT7esGGDHnnkEW3evHlCx5RNaJD7zW9+o3vvvVfSgRmqAAAAlcayLCWTyaxtvu6///5MTiq6ILd48WLz9NNPa9u2bXIchw3vAQBAxQq30tm2LcuytHXrVj355JNaunTphLXKTViQe+ihh/TSSy9JOtBHTKscAACoRJZlZbpWw9t9vfjii3rwwQcn7OdMSJCbP3++efrpp7V+/frM51zXZTIDAACoWLmTH6T9Y+Uef/xxvfDCCxPSKjchQe53v/udli9fnpmh6rouG94DAICKFXStep6XtTSJ4zhauXKlfv3rX0/Izxl3kHvppZfMww8/rK1bt2bGxaVSKfm+r0gkQiUBAEDFCcbFBYLWuVQqpc2bN+uBBx6YkLFy4w5yt956q1atWiXP87KevJS9+C8AAEClCC+/FmQky7Iy+7Fu3bpVt95667h/zri26NqwYYM5+eSTNTAwkLXtliS23gIAABiF53mqqqrS66+/ro6OjqPevmtcLXJLlizRwMBA1lIjwSau4VAHAACAA1KplPr6+rRo0aJxfZ9xBblFixZpaGgo03xIcAMAADi0oNFr4cKFkxPkNm3aZJ599tkD3+jtQX2EOQAAgENzXVcLFy4c17ZdRx3knn/++UxzoGVZB3WpBp8DAABANsuylE6ntWjRIi1YsOCov89RBbmdO3cufvHFFzUwMCDpwLi44EGrHAAAwOiMMbJtW4ODg/rjH/+ooaGh2QULcuvXrz/ttddey1pyJPfJAQAAYIwQZtvyPE8rV67UypUrf1qwILdhwwatWrUqM1vVtu3M2nFBkCPMAQAAjB7iksmkksmkXn/9df3pT386uu9zNP/piSee0Jo1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',
          ),
        ),
      ),
    ),
  ),
);
