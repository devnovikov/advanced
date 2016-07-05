<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

\Yii::setAlias('theme_view', '@frontend/themes/advert/views');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',

    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],

        'cabinet' => [
            'class' => 'app\modules\cabinet\Module',
        ],

    ],
    'defaultRoute' => 'main', // ссылка, которая будет открываться по умолчанию при загрузки страницы
    'components' => [
        'mail' => [
            'class'            => 'zyx\phpmailer\Mailer',
            'viewPath'         => '@common/mail',
            'useFileTransport' => false, // Если стоит true, то при отправке письма будет сохр. локальная копия frontend/runtime/mail
            'config'           => [
                'mailer'     => 'smtp',
                'host'       => 'smtp.yandex.ru',
                'port'       => '465',
                'smtpsecure' => 'ssl',
                'smtpauth'   => true,
                'username'   => 'vka643@yandex.ru',
                'password'   => 'qwerty1234',
                'ishtml'   => true,
                'charset'   => 'UTF-8',
            ],
        ],

/*
        'view' => [
            'theme' => [
                'class' => 'frontend\themes\advert\Theme',
                'basePath' => '@app/',
                'baseUrl'  => '@web/',
            ],
        ],
*/

        'common' => [
          'class' => 'frontend\components\Common',
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/main/main/login' // Направляем неавторизованных пользователей на нашу форму
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
