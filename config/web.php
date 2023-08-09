<?php

/**
 * @author Chetan Patel <cpjeslot@gmail.com>>
*/

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';


$config = [

    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\controllers',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@vendor'   => '@vendor',
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Module'
        ]
    ],
    'components' => [
        'db' => $db,
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'jwt' => [
            'class' => \kaabar\jwt\Jwt::class,
            'key' => 'iJ9n6OiNJctJDE9ebMaXjlyRhWgZvUpm0bCWfsLx2LHb6JdVbZAXxnUEPi84rk8asISIN1KWX7UbIZtVaf8k60h7wFhBs7yFcK0s',  //typically a long random string
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'M0VtYiIeDD2_zbhlAkYMd7JAjJhjyCJf',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'code' => $response->statusCode,
                        'message' => $response->statusText,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
        ],
    ],
    'params' => $params,
];

return $config;
