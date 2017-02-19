<?php

namespace Charonne\Ethapi;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

 
class Contract
{
    protected $url;
    protected $client;
    protected $token;

    public function __construct($client, $token)
    {
        $this->client = $client;
        $this->token = $token;
    }
    
    /**
     * Check if string is json
     */
    public function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Create a new contract
     */
    public function create($sol)
    {
        // Format contract
        $sol = preg_replace('/[\n\r]+/', '\n\n', $sol);
        
        // Set request
        $res = $this->client->request('POST', 'contracts/create', [
            'headers' => [
                'x-access-token' => $this->token,
            ],
            'json' => ["source" => $sol]
        ]);
        // Get response
        if ($res->getStatusCode() == 200) {
            return json_decode($res->getBody());
        }
    }

    /**
     * Find all contracts
     */
    public function find()
    {
        // Set request
        $res = $this->client->get(    'contracts');
        // Get response
        if ($res->getStatusCode() == 200) {
            return json_decode($res->getBody());
        }
        return null;
    }

    /**
     * Find one contract
     */
    public function findOne($id)
    {
        // Set request
        $res = $this->client->request('GET', 'contracts/' . $id, [
            'headers' => [
                'x-access-token' => $this->token,
            ]
        ]);
        // Get response
        if ($res->getStatusCode() == 200) {
            return json_decode($res->getBody());
        }
        return null;
    }
    
    /**
     * Deploy a contract
    */
    public function deploy($contractId, $params = null)
    {
        // Check contract
        $contract = $this->findOne($contractId);
        if (!$contract) {
            $response['status'] = 'error';
            $response['message'] = 'CONTRACT_ERROR_NONE';
            // Response
            return (object) $response;
        }

        // Set request
        $res = $this->client->request('POST', 'contracts/deploy', [
            'headers' => [
                'x-access-token' => $this->token,
            ],
            'json' => ['contract_id' => $contractId, 'params' => $params]
        ]);
        // Get response
        if ($res->getStatusCode() == 200) {
            // Response
            return json_decode($res->getBody());
        }
    }
    
}