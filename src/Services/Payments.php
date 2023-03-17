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

    /**
     * Get all payments
     *
     * @link https://swahilies.readme.io/reference/get-reconciliation-list-1
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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

    /**
     * @return array
     *
     * @internal
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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

    /**
     * Make a payment request
     *
     * @link https://swahilies.readme.io/reference/create-check-out-order-1
     *
     * @return array
     */
    public function request(array $data)
    {
        return $this->create($data);
    }

    /**
     * @deprecated 0.1.0 Use directRequest() instead
     */
    public function directPush(array $data)
    {
        return $this->create($data, 104);
    }

    /**
     * Make a direct payment request, no checkout page is shown
     *
     * @link https://swahilies.readme.io/reference/create-check-out-order-complete-1
     *
     * @return array
     */
    public function directRequest(array $data)
    {
        return $this->create($data, 104);
    }

    /**
     * Get a payment by ID (Using Client Order ID)
     *
     * @link https://swahilies.readme.io/reference/get-order-status-1
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find(string $id)
    {
        $data = [
            'api_key' => $this->options['apiKey'],
            'order_id' => $id,
        ];

        $payload = [
            'api' => 170,
            'code' => 105,
            'data' => $data,
        ];
        $response = $this->httpClient->post('', [
            'json' => $payload,
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
