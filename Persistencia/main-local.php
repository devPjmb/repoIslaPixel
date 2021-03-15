<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=LaPrepa',
            'username' => 'root',
            'password' => '12345',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
                'messageConfig' => [
                    'from' => 'noreply@example.com' // sender address goes here
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.mydesk.digital',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'noreply@mydesk.digital',
                'password' => 'DPk$G_?k=1*TT',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
    ],
];
