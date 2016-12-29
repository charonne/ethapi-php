<?php

namespace Charonne\Ethapi\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


use Charonne\Ethapi\Callback;
 
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
        $transaction = (object) [
            'tx_id' => $inputs['tx_id'],
            'tx_hash' => $inputs['tx_hash'],
            'contract_address' => $inputs['contract_address'],
            'confirmed' => $inputs['confirmed'],
        ];
        
        Callback::deploy($transaction);
    }
    
    /**
     * Exec
     */
    private function exec($inputs)
    {
        $transaction = (object) [
            'tx_id' => $inputs['tx_id'],
            'tx_hash' => $inputs['tx_hash'],
            'confirmed' => $inputs['confirmed'],
        ];
        
        Callback::exec($transaction);
    }
    
}