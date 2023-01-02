<?php

declare(strict_types=1);

namespace Alphaolomi\Swahilies;

use GuzzleHttp\Client;

/**
 * Swahilies
 *
 * @version 1.0
 *
 * @author Alpha Olomi
 */
class Swahilies
{
    const BASE_API_URL = 'https://swahiliesapi.invict.site/Api';

    private $httpClient;

    public function __construct(
        array $options = [],
        $httpClient = null
    ) {
        $this->options = $options;
        $this->httpClient = $httpClient ?: new Client([
            'base_uri' => self::BASE_API_URL,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    public static function create(array $options = [], array $httpOptions = [])
    {
        $_httpClient = new Client(array_merge([
            'base_uri' => self::BASE_API_URL,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ], $httpOptions));

        return new Swahilies($options, $_httpClient);
    }

    public function payments()
    {
        return new Services\Payments($this->httpClient, $this->options);
    }

    public function webhooks()
    {
        return new Services\Webhooks($this->httpClient, $this->options);
    }
}
