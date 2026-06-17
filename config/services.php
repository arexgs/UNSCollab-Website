<?php

return [

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // ← tambahkan di sini
    'supabase' => [
        'url'    => env('https://qdcjgonjjrxhghlbdarz.supabase.co'),
        'key'    => env('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFkY2pnb25qanJ4aGdobGJkYXJ6Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODEyNTkzMDMsImV4cCI6MjA5NjgzNTMwM30.PbvvDNzw2X0evntV2Ksw_tbypR2DjE8R4r7nUW7DHeM'),
        'bucket' => env('SUPABASE_BUCKET', 'logo-comp'),
    ],
];