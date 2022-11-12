<?php

namespace Alphaolomi\Swahilies\Services;

use GuzzleHttp\Client;

class Payments
{
    public function __construct(Client $httpClient, $options)
    {
        $this->httpClient = $httpClient;
        $this->options = $options;
    }

    public function all()
    {
        $response = $this->httpClient->post("", [
            'json' => [
                "api"  => 170,
                "code" => 103,
                "data" => ["api_key" => $this->options['apiKey']]
            ]
        ]);
        return json_decode((string) $response->getBody(), true);
    }

    public function create(array $data)
    {
        $payload = [
            "api" => 170,
            "code" => 101,
            "data" => [
                "api_key" => $this->options['apiKey'],
                "order_id" => $this->generateRandomString(10),
                "amount" => $data['amount'],
                "phone_number" => $data['phoneNumber'],
                "success_url" => $data['successUrl'],
                "cancel_url" => $data['cancelUrl'],
                "webhook_url" => $data['webhookUrl'],
                "metadata" => $data['metadata'] ?? [],
                "username" => $this->options['username'] ?: $data['username'],
                "is_live" => $this->options['isLive'],
            ]
        ];
        $response = $this->httpClient->post("", [
            'json' => $payload
        ]);
        return json_decode((string) $response->getBody(), true);
    }

    public function request(array $data)
    {
        return $this->create($data);
    }

    public function get(string $id)
    {
        $data = [
            "api_key" => $this->options['apiKey'],
            "order_id" => $id
        ];

        $payload = [
            "api"  => 170,
            "code" => 103,
            "data" => $data
        ];
        $response = $this->httpClient->post("", [
            'json' => $payload
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
