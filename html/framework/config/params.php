<?php

return [
    'HTMLPurifier' => [
        'Attr.AllowedFrameTargets' => [
            '_blank',
            '_self',
            '_parent',
            '_top',
        ],
        'HTML.Trusted' => true,
        'Filter.YouTube' => true,
    ],
    'menu' => [
        [
            'label' => 'Structure',
            'icon' => 'ti-files',
            'items' => [
                [
                    'label' => 'Menu',
                    'url' => ['/menu/default'],
                ],
            ],
        ],
        [
            'label' => 'Content',
            'icon' => 'ti-files',
            'items' => [
                [
                    'label' => 'Content',
                    'url' => ['/content/default'],
                ],
                [
                    'label' => 'News',
                    'items' => [
                        [
                            'label' => 'News',
                            'url' => ['/news/default'],
                        ],
                        [
                            'label' => 'News Group',
                            'url' => ['/news/group'],
                        ],
                    ],
                ],
            ],
        ],
        [
            'label' => 'Guide',
            'icon' => 'ti-files',
            'items' => [
                [
                    'label' => 'Directory',
                    'url' => ['/directory/default'],
                ],
            ],
        ],
        [
            'label' => 'Subscriber',
            'items' => [
                [
                    'label' => 'Subscriber',
                    'url' => ['/subscriber/subscriber'],
                ],
                [
                    'label' => 'Subscription Group',
                    'url' => ['/subscriber/subscription-group'],
                ],
            ],

        ],
        [
            'label' => 'postManager',
            'url' => ['/postManager/default'],
        ],
    ],
    'dropdown' => [
        [
            'label' => 'Users',
            'icon' => 'ti-user',
            'items' => [
                [
                    'label' => 'Auth',
                    'url' => ['/auth/auth'],
                ],
                [
                    'label' => 'Social network',
                    'url' => ['/auth/social'],
                ],
                [
                    'label' => 'Log',
                    'url' => ['/auth/log'],
                ],
            ],
        ],
        [
            'label' => 'Systemic',
            'icon' => 'ti-settings',
            'items' => [
                [
                    'label' => 'Configure',
                    'url' => ['/configure'],
                ],
                [
                    'label' => 'Clear cache',
                    'url' => ['/system/default/flush-cache'],
                ],
                [
                    'label' => 'Backup',
                    'url' => ['/backup/default'],
                ],
            ],
        ],
    ],
];
