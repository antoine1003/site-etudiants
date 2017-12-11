<?php

return [

    '404' => [
        'title'       => 'Erreur 404',
        'main_site'   => 'Retour au site',
        'description' => 'La page que vous cherchez n\'a pas été trouvée.'
    ],

    '403' => [
        'title'       => 'Erreur 403',
        'main_site'   => 'Retour au site',
        'description' => 'Vous n\'avez pas à acceder à cette page !',
    ],
    'maintenance' =>
    [
        'title'    => 'Notre site est actuellement en maintenance',
        'subtitle' => 'Nous seront de retour après quelques instants.',
        'why_down' => [
            'title' => 'Pourquoi le site est en maintenance?',
            'body' => 'Afin de maintenir notre site à jours nous devons régulièrement effectuer des améliorations. Celles-ci engendrent alors une indisponibilité du site pendant un certain temps.',
        ],
        'time_down' => [
            'title' => 'Temps de la maintenance',
            'body' => 'Nous avons estimé la durée de la maintenance à :time minutes. Veuillez-nous excuser pour la gène occasionnée.',
        ],
    ],

];
