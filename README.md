YII2 Project

baseUrl

- for frontend `/YII2/frontend/web/`
- for backend `/YII2/backend/web/`

To change rules look in YII2/frontend/config.main.php

    'urlManagerFrontEnd' => [
        'class' => 'yii\web\urlManager',
        'baseUrl' => '/YII2/frontend/web',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
    ],
    'urlManagerBackEnd' => [
        'class' => 'yii\web\urlManager',
        'baseUrl' => '/YII2/backend/web',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
    ],
