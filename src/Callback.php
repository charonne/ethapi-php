<?php

namespace Charonne\Ethapi;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

 
class Callback
{
    
    /**
     * Deploy callback
     */
    static function deploy($transaction) {
        // Get infos
        $transactionId = $transaction->tx_id;
        $transactionHash = $transaction->tx_hash;
        $contractAddress = $transaction->contract_address;
        $confirmed = $transaction->confirmed;
        
        // Do something...
        $message = date("Y-m-d H:i:s") . ";" . 
            "actions for transactionId: $transactionId" . ";" . 
            "transactionHash: $transactionHash" . ";" . 
            "contractAddress: $contractAddress" . ";" . 
            "confirmed: $confirmed..." . "\n";
        $tempFile = sys_get_temp_dir() . '/ethapi.debug';
        file_put_contents($tempFile, $message, FILE_APPEND | LOCK_EX);
        // die($message);
        // /Do something...
        
        // Response
        return true;
    }
    
    /**
     * Exec callback
     */
    static function exec($transaction) {
        // Get infos
        $transactionId = $transaction->tx_id;
        $transactionHash = $transaction->tx_hash;
        $confirmed = $transaction->confirmed;
        
        // Do something...
        $message = date("Y-m-d H:i:s") . ";" . 
            "actions for transactionId: $transactionId" . ";" .
            "transactionHash: $transactionHash" . ";" .
            "confirmed: $confirmed..." . "\n";
        $tempFile = sys_get_temp_dir() . '/ethapi.debug';
        file_put_contents($tempFile, $message, FILE_APPEND | LOCK_EX);
        // die($message);
        // /Do something...

        // Response
        return true;
    }

}