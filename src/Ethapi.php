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
    public $contract;
    public $transaction;

    public function __construct()
    {
        // Set url
        $this->url = config('ethapi.server_url') . "/";
        $this->url = preg_replace('#/+$#','/', $this->url);
        // Set client
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
                
                $this->setContract();
                $this->setTransaction();
                
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
    public function setContract()
    {
        if (is_null($this->contract)) {
            $this->contract = new Contract($this->url, $this->client, $this->token);
        }
        return $this;
    }


    /**
     * Get transaction
     */
    public function setTransaction()
    {
        if (is_null($this->transaction)) {
            $this->transaction = new Transaction($this->url, $this->client, $this->token);
        }
        return $this;
    }
    
}