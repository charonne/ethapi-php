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

    'api_key' => '1234-5678-9101',
    'password' => 'ethapi',

    /*
    |--------------------------------------------------------------------------
    | Ethapi server
    |--------------------------------------------------------------------------
    |
    | Auth credential
    |
    */

    'server_url' => 'https://ethapi.democrypt.com/',

    /*
    |--------------------------------------------------------------------------
    | Deploy callback method 
    |--------------------------------------------------------------------------
    |
    | Method used when deploy callback is called
    |
    */

    'deploy_callback_method' => '\Charonne\Ethapi\Callback::deploy',

    /*
    |--------------------------------------------------------------------------
    | Exec callback method
    |--------------------------------------------------------------------------
    |
    | Method used when exec callback is called
    |
    */

    'exec_callback_method' => 'Charonne\Ethapi\Callback::exec',

];
