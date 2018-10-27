<?php

return [

    'yandex' => [
        'feed' => [
            'limit' => 200,
            'title' => '',
            'description' => '',
            'language' => 'ru',
            'dateformat' => 'datetime',
            'view' => 'admin.module.rss::front.rss.yandex',
            'type' => 'text/xml',
            'format' => 'rss',
        ],
        'sources' => [
        ],
    ],

];
