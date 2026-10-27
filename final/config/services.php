<?php

return [
    // Google Gemini AI
    'gemini' => [
        'key' => env('GEMINI_API_KEY'),
    ],

    // (Opsional) OpenAI — jika suatu saat ingin beralih ke GPT
    'openai' => [
        'key' => env('OPENAI_API_KEY'),
    ],

    // Layanan bawaan Laravel
    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel'              => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];