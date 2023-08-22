<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'facebook' => [

        'client_id' => '569150813607336',
        'client_secret' => '3bc474ae90ede33cb7d12689ca347896',
        'redirect' => 'https://web.mobiloitte.com/PROJECTS/SisrMe/trunk/public/login/facebook/callback',

    ],
    'google' => [

        'client_id' => '1234455-u3ifk8tr1qs41487fmevg2h2s1v6ubue.apps.googleusercontent.com',
        'client_secret' => 'DxSOS0p1xKNuPger3IS_E4-i',
        'redirect' => 'http://172.16.0.7/PROJECTS/b2b-and-ecommerce-platform-19103627-lamp/b2b-and-ecommerce-platform-19103627-lamp/b2b/public/login/Google/callback',

    ],

    'recaptcha' => [
        'key' => '6Lf9jQUbAAAAAH3WKa9ooj4tv-a2GKJqbh2yk10s',
        'secret' => '6Lf9jQUbAAAAAIULQNo4Eq7n75x_c9SkFpL1wkoU',
    ],

];
