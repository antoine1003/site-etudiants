<?php

return [

	'mails' => [
		'verification_mail_send' => 'Un mail de vérification a été envoyé à :usermail. Merci de vérifier votre boite mail et de cliquer sur le lien afin de valider votre compte.',
		'mail_subject_verif' => 'Validez votre compte !',		
		'resendsuccess' => 'L\'email de vérification a bien été envoyé à l\'adresse suivante : :email',		
		'resenderror' => 'Une erreur c\'est produite lors de l\'envois du mail de vérification. Merci de bien vouloir réessayer en <a href="email-verification/resend/:email">cliquant ici</a>. Si l\'erreur persiste, veuillez contacter le support.',
		'verifsuccess' => '<strong>Félicitation!</strong> Votre compte a été correctement validé. Vous pouvez maintenant vous connecter.',
	],

	'exceptions' => [
		'csrf_error' => 'Une erreur c\'est produite lors de l\'envoi de la requête. Merci de réessayer.',
		'user_already_verified' => 'Votre mail à déjà été vérifié !',
	],

	'front' => [
		'maxattempt' => 'Vous avez atteinds le nombre maximums d\'essais. Merci de bien vouloir réessayer dans :minutes minutes.',
		'badcredentials' => 'Vos identifiants sont incorrects. Merci de bien vouloir réessayer.',
		'emailpending' => 'Merci de valider votre adresse mail afin de pouvoir continuer. Si vous n\'avez pas reçu le mail, <a href="email-verification/resend/:email">cliquez ici</a> pour le réenvoyer',
		'logoutsuccess' => 'Vous avez été correctement déconnecté!',
	],
];
