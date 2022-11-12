<?php

declare(strict_types=1);

namespace Alphaolomi\Swahilies;

use GuzzleHttp\Client;

class Swahilies
{
    private $baseUrl = "https://swahiliesapi.invict.site/Api";

    //
    public function __construct(
        $options = [],
        $httpClient = null
    ) {
        $this->options = $options;
        $this->httpClient = $httpClient ?: new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept'     => 'application/json',
            ]
        ]);
    }

    public static function create(array $options = [])
    {
        return new Swahilies($options);
    }

    public function payaments()
    {
        return new Services\Payments($this->httpClient, $this->options);
    }

    public function webhooks()
    {
        return new Services\Webhooks($this->httpClient, $this->options);
    }
}
