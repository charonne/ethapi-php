<?php

Route::post('ethapi/callback', 
  'Charonne\Ethapi\Controllers\CallbackController@callback');

Route::get('ethapi/callback', 
  'Charonne\Ethapi\Controllers\CallbackController@callback');
