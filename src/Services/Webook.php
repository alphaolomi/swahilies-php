<?php

namespace Alphaolomi\Swahilies\Services;

class Webhooks
{
    public function __construct($options = [])
    {
        $this->options = $options;
    }

    public function getDisget(array $data = []): string
    {
        $fordigest = [
            "timestamp" => date('c'),
            "server_ip" => $data['server_ip'],
            "api_key" => $this->options['apiKey'],
        ];
        $toDigest = "";
        foreach ($data as $key => $value) {
                $toDigest .= "&" + $key + "=" + $fordigest[$key];
        }
        $digest = base64_encode(hash_hmac('sha256', $toDigest, $this->options['apiSecret'], true));
        return $digest;
    }

    public function verify($data): bool
    {
        $digest = $this->getDisget($data);
        if ($digest == $data['digest']) {
            return true;
        }
        return false;
    }
}
