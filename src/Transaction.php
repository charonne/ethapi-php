<?php

namespace Charonne\Ethapi;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

 
class Transaction
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
     * Find all contract
     */
    public function find()
    {
        $res = $this->client->get('transactions');
        if ($res->getStatusCode() == 200) {
            $response = $res->getBody();

            var_dump(json_decode($response));
        }
        die('contract \oo/');
    }

    /**
     * Find one contract
     */
    public function findOne($id)
    {
        // Request
        $res = $this->client->request('GET', 'transactions/' . $id, [
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
     * Exec a contract
     */
    public function exec($contractAddress, $method, $params = null)
    {
        // Set request
        $res = $this->client->request('POST', 'contracts/exec', [
            'headers' => [
                'x-access-token' => $this->token,
            ],
            'json' => ['contract_address' => $contractAddress, 'method' => $method, 'params' => $params]
        ]);
        // Get response
        if ($res->getStatusCode() == 200) {
            return json_decode($res->getBody());
        }
    }

}