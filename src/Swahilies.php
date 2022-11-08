<?php

declare(strict_types=1);

namespace Alphaolomi\Swahilies;

use GuzzleHttp\Client;

class Swahilies
{
    public function __construct(
        $options = [],
        $httpClient = null
    ) {
        $this->httpClient = $httpClient ?: new Client($options);
        $this->options = $options;
    }

    public static function create(array $options = [])
    {
        return new Swahilies($options, new Client());
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
