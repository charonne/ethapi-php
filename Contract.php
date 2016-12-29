<?php

namespace Charonne\Ethapi;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

 
class Contract
{
    protected $url;
    protected $client;
    protected $token;

    public function __construct($url, $client, $token)
    {
        $this->url = $url;
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
        $res = $this->client->request('POST', $this->url . 'contracts/create', [
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
        $res = $this->client->get($this->url . 'contracts');
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
        $res = $this->client->request('GET', $this->url . 'contracts/' . $id, [
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
        // Check params
        if (!is_null($params) && $this->isJson($params) == false) {
            return 'JSON_ERROR_NONE';
        }
        
        // Check contract
        $contract = $this->findOne($contractId);
        if (!$contract) {
            return 'CONTRACT_ERROR_NONE';
        }

        // Set request
        $res = $this->client->request('POST', $this->url . 'contracts/deploy', [
            'headers' => [
                'x-access-token' => $this->token,
            ],
            'json' => ['contract_id' => $contractId, 'params' => $params]
        ]);
        // Get response
        if ($res->getStatusCode() == 200) {
            return json_decode($res->getBody());
        }
    }
    
}