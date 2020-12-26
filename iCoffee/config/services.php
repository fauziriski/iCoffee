<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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

    /* Social Media */
    'facebook' => [
        'client_id'     => '406780327067617',
        'client_secret' => 'c144e84c21900a84cc8503abddeda296',
        'redirect'      => 'https://icoffee.id/login/facebook/callback'
    ],

    'google' => [
        'client_id'     => '841364276755-6kio36kto9e4aghttj3lkried4m03or0.apps.googleusercontent.com',
        'client_secret' => 'xalChsfxl1_oZCVrpX4kXWri',
        'redirect'      => 'https://icoffee.id/login/google/callback'
    ],

];
