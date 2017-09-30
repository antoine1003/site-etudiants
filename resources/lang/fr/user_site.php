<?php

return [



    'welcome' => [
    	'title' => 'Étape :number',

        'one' => [
	        'message_h1' => 'Bonjour et bienvenue sur :nom_site!',
	        'message_body' => 'Vous venez de vous inscrire sur notre site et vous devez maintenant nous indiquer votre rôle afin que nous puissions vous attribuer les droits nécessaires. Sachez que si vous êtes à la fois parents et professeur (ou élève) vous pourrez le modifier par la suite dans votre espace personnel',
	        'student_desc' => 'Je prends ou vais prendre des cours avec un ou des professeur(s) utilisant(s) :nom_site. Et mes parents ont choisis de prendre cette option avec ce(s) professeur(s).',
	        'teacher_desc' => 'Je donne des cours particuliers et souhaite donner la possibiliter aux parents de bénéficier d\'un suivis plus poussé.',
	        'parent_desc' => 'Je suis parent d\'élève prenant des cours particuliers et j\'ai convenu avec le professeur d\'utiliser :nom_site.',
        	],
    	'two' => [
	    	'student' => [
				'title'                => 'Vous êtes un étudiant',
				'body'                 => 'Afin de contruire votre profil, vous devez maintenant choisir votre classe grâce au champs ci-dessous. Si vous classe ne figure pas dedant vous pouvez nous proposer votre classe en cliquant sur le lien en dessous.',
				'class'                => 'Classe',
				'dontfindclass'        => 'Vous ne trouvez pas votre classe?',
				'addclasstitle'        => 'Ajouter une classe',
				'classname'            => 'Nom de la classe',
				'validate'             => 'Valider',
				'cancel'               => 'Annuler',
				'classempty'           => 'Le nom de la classe ne peut pas être vide !',
				'categoryalreadyexist' => 'Cette catégorie existe déjà !',
				'cancelclassadd'       => 'Annuler la proposition de classe.',
				'category'             => 'Catégorie',
				'dontfindcategorie'    => 'Ajouter une catégorie',
	    	],    	
    	],

    	'three' => [
				'title' => 'Bravo !',
				'body'  => 'Vous venez de finaliser votre inscription en tant que :type. Vous pouvez par la suite choisir d\'autre type via l\'onglet "Mon compte".',
				'next'  => 'Vous pouvez maintenant accéder à votre espace en cliquant sur le bouton ci dessous. Pour toute question suplémentaires, n\'hésitez pas à nous contacter sur notre adresse mail : :mail_contact.',
				'dashboard_name' => 'Allez à mon espace',
    		],

	    'type' => [
			'student' => 'Élève',
			'teacher' => 'Professeur',
			'parent'  => 'Parent',
	    	],
    ],

    'dashboard' => [
    		'title' => 'Accueil utilisateur',
    		'menu' => [
    			'my_account' => 'Mon compte',
    			'manage_student' => '',
    			],
    	],

];
