<?php

return [

	'mails' => [
		'verification_mail_send' => 'Un mail de vérification a été envoyé à :usermail. Merci de vérifier votre boite mail et de cliquer sur le lien afin de valider votre compte.',	
		'resendsuccess' => 'L\'email de vérification a bien été envoyé à l\'adresse suivante : :email.',		
		'resenderror' => 'Une erreur c\'est produite lors de l\'envois du mail de vérification. Merci de bien vouloir réessayer en <a href="email-verification/resend/:email">cliquant ici</a>. Si l\'erreur persiste, veuillez contacter le support.',
		'verifsuccess' => '<strong>Félicitation!</strong> Votre compte a été correctement validé. Vous pouvez maintenant vous connecter.',
		'veriffailed_usernotexist' => '<strong>Erreur!</strong> L\'adresse mail n\'existe pas dans notre système.',
		'veriffailed_already' => '<strong>Erreur!</strong> L\'adresse mail n\'existe pas dans notre système.',
	],

	'exceptions' => [
		'csrf_error' => 'Une erreur c\'est produite lors de l\'envoi de la requête. Merci de réessayer.',
		'user_already_verified' => 'Votre mail à déjà été vérifiée!',
		'usernotexist' => '<strong>Erreur!</strong> L\'adresse mail n\'existe pas dans notre système.',
		'token_mismatch' => '<strong>Erreur!</strong> Le jeton donné ne correspond pas avec celui dans notre base de donnée. Vous pouvez essayer de générer un nouveau lien en <a href="email-verification/resend/:email">cliquant ici</a>.',
	],

	'front' => [
		'maxattempt' => 'Vous avez atteinds le nombre maximum d\'essais. Merci de bien vouloir réessayer dans :minutes minutes.',
		'badcredentials' => 'Vos identifiants sont incorrects. Merci de bien vouloir réessayer.',
		'emailpending' => 'Merci de valider votre adresse mail afin de pouvoir continuer. Si vous n\'avez pas reçu le mail, <a href="email-verification/resend/:email">cliquez ici</a> pour le réenvoyer.',
		'logoutsuccess' => 'Vous avez été correctement déconnecté!',
		'welcome_wrongchoice' => 'Votre choix n\'est pas correct. Merci de bien vouloir réessayer.',
		'userisblocked' => 'Votre compte a été bloqué par un administrateur, pour en savoir plus merci de nous contacter ici : :support_mail. Vous pouvez retrouver la raison de ce blocage dans un mail que nous vous avons envoyé le :date_blocage.',
		'mail_ok' => 'Votre mail à été correctement vérifié!',
	],
	'modal' => [
		'welcome' => [
			'title' => 'Attention',
			'description' => 'Vous êtes sur le point de vous déconnecter, si vous continuer votre progression sera perdu. Voulez vous continuer?',
			'option_yes' => 'Oui',
			'option_cancel' => 'Annuler',
		],
	],
];
