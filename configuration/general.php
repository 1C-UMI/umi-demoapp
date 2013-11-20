<?php
use umi\authentication\IAuthenticationFactory;
use umi\authentication\toolbox\AuthenticationTools;
use umi\dbal\toolbox\DbalTools;
use umi\orm\collection\ICollectionFactory;
use umi\orm\toolbox\ORMTools;

return [
    /**
     * Конфигурация тулкита для тестового окружения
     */
    'toolkit'     => [
        AuthenticationTools::NAME => [
            'factories' => [
                'authentication' => [
                    'defaultAdapter' => [
                        'type' => IAuthenticationFactory::ADAPTER_ORM,
                        'options' => [
                            'collection' => 'users',
                            'loginFields' => ['login', 'email'],
                            'passwordField' => 'password'
                        ]
                    ],
                    'defaultStorage' => [
                        'type' => IAuthenticationFactory::STORAGE_ORM_SESSION
                    ]
                ]
            ]
        ],

        DbalTools::NAME => [
            'servers' => [
                [
                    'id'     => 'demoDB',
                    'type'   => 'master',
                    'driver' => [
                        'type'    => 'sqlite',
                        'options' => [
                            'dsn' => 'sqlite:' . __DIR__ . '/../demo.db'
                        ]
                    ]
                ]
            ],
        ],
        ORMTools::NAME  => [
            'metadataManagerCollections'   => [
                'posts'    => '{#lazy:~/metadata/posts.config.php}',
                'users'    => '{#lazy:~/metadata/users.config.php}',
                'tags'     => '{#lazy:~/metadata/tags.config.php}',
                'postTags' => '{#lazy:~/metadata/post_tags.config.php}'
            ],
            'collectionManagerCollections' => [
                'posts'    => ['type' => ICollectionFactory::TYPE_SIMPLE],
                'users'    => ['type' => ICollectionFactory::TYPE_SIMPLE],
                'tags'     => ['type' => ICollectionFactory::TYPE_SIMPLE],
                'postTags' => ['type' => ICollectionFactory::TYPE_SIMPLE]
            ]
        ]
    ],

    'application' => '{#lazy:~/application/component.config.php}'
];
