<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Auth access
    |--------------------------------------------------------------------------
    |
    | Auth credential
    |
    */

    'api_key' =>  env('ETHAPI_API_KEY', '1234-5678-9101'),
    'password' =>  env('ETHAPI_API_PASSWORD', 'demo'),
    
    /*
    |--------------------------------------------------------------------------
    | Callback url
    |--------------------------------------------------------------------------
    |
    | Callback url to get ethapi response
    |
    */
    
    'callback_url' => env('ETHAPI_CALLBACK_URL', '/ethapi/callback'),

    /*
    |--------------------------------------------------------------------------
    | Ethapi server
    |--------------------------------------------------------------------------
    |
    | Auth credential
    |
    */

    'server_url' => env('ETHAPI_SERVER_URL', 'https://ethapi.democrypt.com/'),

    /*
    |--------------------------------------------------------------------------
    | Deploy callback method 
    |--------------------------------------------------------------------------
    |
    | Method used when deploy callback is called
    |
    */

    'deploy_callback_method' => '\App\Factory\Vote\Callback::deploy',

    /*
    |--------------------------------------------------------------------------
    | Exec callback method
    |--------------------------------------------------------------------------
    |
    | Method used when exec callback is called
    |
    */

    'exec_callback_method' => '\App\Factory\Vote\Callback::exec',

];
