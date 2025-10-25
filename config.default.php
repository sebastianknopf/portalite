<?php

return [
    'index' => [
        'title' => 'PortaLite',
        'subtitle' => 'Subtitle',
        'description' => 'PortaLite is a extremly light-weight, desktop and mobile ready, index portal page with dynamic configuration options using one single PHP file. No installation required, no external dependencies. Try it out!',
        'logo' => '/img/logo.svg',
        'colors' => [
            'background' => [
                'primary' => '#008c99',
                'secondary' => '#f8f8f8',
                'accent' => '#99cc04',
            ],
            'text' => [
                'textOnPrimary' => '#ffffff',
                'textOnSecondary' => '#888888',
                'textOnAccent' => '#ffffff',
                'headlineEmphasis' => '#112211'
            ]
        ],
        'robots' => 'noindex, nofollow',
        'groups' => [
            [
                'title' => 'Group #1',
                'description' => 'This a first group of different index links.',
                'entries' => [
                    [
                        'title' => 'Entry #1',
                        'description' => 'This is like an entry is configured.',
                        'links' => [
                            [
                                'title' => 'Google',
                                'url' => 'https://google.com',
                                'target' => '_blank'
                            ],
                            [
                                'title' => 'GitHub',
                                'url' => 'https://github.com',
                                'target' => '_self'
                            ],
                        ],
                    ],
                ],
            ],
            [
                'entries' => [
                    [
                        'title' => 'Entry #2',
                        'links' => [
                            [
                                'title' => 'GitHub',
                                'url' => 'https://github.com',
                                'target' => '_self'
                            ],
                        ],
                    ],
                ],
            ]
        ],
    ],
];