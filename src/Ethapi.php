<?php

namespace Charonne\Ethapi;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


use Charonne\Ethapi\Contract;
use Charonne\Ethapi\Transaction;

class Ethapi
{
    public $url;
    protected $client;
    protected $token;
    protected $contract;
    protected $transaction;

    public function __construct()
    {
        $this->url = config('ethapi.server_url');
        $this->client = new Client();
    }
    
    /**
     * JWT auth
     */
    public function auth($login, $password)
    {
        if (is_null($this->token)) {
            // Send request
            $res = $this->client->request('POST', $this->url . 'accounts/login',
                ['json' => ['username' => $login, 'password' => $password]]
            );
            // Get token
            if ($res->getStatusCode() == 200) {
                $response = $res->getBody();
                $auth = json_decode($response);
                $this->token = $auth->token;
                return true;
            }
        }
        return false;
    }
    
    /**
     * Set callback url
     */
    public function setCallbackUrl($callbackUrl)
    {
        // Request
        $res = $this->client->request('POST', $this->url . 'accounts/update', [
            'headers' => [
                'x-access-token' => $this->token,
            ],
            'json' => ['callback' => $callbackUrl]
        ]);
        // Get response
        if ($res->getStatusCode() == 200) {
            $response = $res->getBody();
            return json_decode($response);
        }
    }

    /**
     * Get contract
     */
    public function contract()
    {
        if (is_null($this->contract)) {
            $this->contract = new Contract($this->url, $this->client, $this->token);
        }
        return $this->contract;
    }


    /**
     * Get transaction
     */
    public function transaction()
    {
        if (is_null($this->transaction)) {
            $this->transaction = new Transaction($this->url, $this->client, $this->token);
        }
        return $this->transaction;
    }
    
}