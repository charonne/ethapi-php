<?php

namespace Charonne\Ethapi\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


 
class CallbackController extends Controller
{
 
    public function callback(Request $request)
    {
        // Get tx action
        switch ($request->input('action')) {
            case 'deploy' :
                $this->deploy($request->all());
                break;
            case 'exec' :
                $this->exec($request->all());
                break;
            default:
                // Response
                return response()->json([
                    'status' => 'error',
                    'messages' => 'ERR_ACTION_NOT_FOUND'
                ]);
        }
        
        // Response
        return response()->json([
            'status' => 'success'
        ]);
    }
    
    /**
     * Deploy
     */
    private function deploy($inputs)
    {
        try {
            $transaction = (object) [
                'tx_id' => $inputs['tx_id'],
                'tx_hash' => $inputs['tx_hash'],
                'contract_address' => $inputs['contract_address'],
                'confirmed' => $inputs['confirmed'],
            ];
            
            // Callback method
            $callbackMethod = config("ethapi.deploy_callback_method");
            call_user_func($callbackMethod, $transaction);
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
    }
    
    /**
     * Exec
     */
    private function exec($inputs)
    {
        try {
            $transaction = (object) [
                'tx_id' => $inputs['tx_id'],
                'tx_hash' => $inputs['tx_hash'],
                'confirmed' => $inputs['confirmed'],
            ];
            
            // Callback method
            $callbackMethod = config("ethapi.exec_callback_method");
            call_user_func($callbackMethod, $transaction);

        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
    }
    
}