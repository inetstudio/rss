<?php

return [

    'yandex' => [
        'feed' => [
            'limit' => 200,
            'title' => '',
            'description' => '',
            'language' => 'ru',
            'dateformat' => 'datetime',
            'view' => 'admin.module.rss.feeds::front.rss.yandex',
            'type' => 'text/xml',
            'format' => 'rss',
        ],
        'sources' => [
        ],
    ],

    // Custom feed example
    'mneniyapro' => [
        'reviews' => [
            'sources' => [
                'items' => 'Packages\ProductsFinder\Products\Services\Front\FeedsService@getMneniyaProFeedItems',
            ],
        ],
    ],

];
