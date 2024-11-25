<?php


return [
    'auth_url' => "https://accounts.salla.sa/oauth2/auth",
    'token_url' => "https://accounts.salla.sa/oauth2/token",
    'callback_url' => env('APP_URL')."/brand/callback",
    'salla-api-url' => "https://api.salla.dev/admin/v2",
];
