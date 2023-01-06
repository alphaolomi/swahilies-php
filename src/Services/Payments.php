<?php

namespace Alphaolomi\Swahilies\Services;

use Alphaolomi\Swahilies\Helpers;

/**
 * @version 1.0
 *
 * @author Alpha Olomi
 */
class Payments
{
    private $httpClient;

    private $options;

    public function __construct($httpClient, $options)
    {
        /** @var GuzzleHttp\Client; */
        $this->httpClient = $httpClient;

        $this->options = $options;
    }

    public function all()
    {
        $response = $this->httpClient->post('', [
            'json' => [
                'api' => 170,
                'code' => 103,
                'data' => ['api_key' => $this->options['apiKey']],
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function create(array $data, int $code = 101)
    {
        $payload = [
            'api' => 170,
            'code' => $code,
            'data' => [
                'api_key' => $this->options['apiKey'],
                'order_id' => array_key_exists('orderId', $data) ? $data['orderId'] : Helpers::generateRandomString(10),
                'amount' => $data['amount'],
                'phone_number' => $data['phoneNumber'],
                'success_url' => $data['successUrl'],
                'cancel_url' => $data['cancelUrl'],
                'webhook_url' => $data['webhookUrl'],
                'metadata' => $data['metadata'] ?? [],
                'username' => $this->options['username'] ?: $data['username'],
                'is_live' => $this->options['isLive'],
            ],
        ];
        $response = $this->httpClient->post('', [
            'json' => $payload,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function request(array $data)
    {
        return $this->create($data);
    }

    public function directPush(array $data)
    {
        return $this->create($data, 104);
    }

    public function find(string $id)
    {
        $data = [
            'api_key' => $this->options['apiKey'],
            'order_id' => $id,
        ];

        $payload = [
            'api' => 170,
            'code' => 103,
            'data' => $data,
        ];
        $response = $this->httpClient->post('', [
            'json' => $payload,
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
