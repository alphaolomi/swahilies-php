# Swahilies for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alphaolomi/swahilies-php.svg?style=flat-square)](https://packagist.org/packages/alphaolomi/swahilies-php)
[![Tests](https://github.com/alphaolomi/swahilies-php/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/alphaolomi/swahilies-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/alphaolomi/swahilies-php.svg?style=flat-square)](https://packagist.org/packages/alphaolomi/swahilies-php)

## Installation

You can install the package via composer:

```bash
composer require alphaolomi/swahilies-php
```

## Usage

```php
use Alphaolomi\Swahilies\Swahilies;

$swahilies = Swahilies::create([
    'apiKey' => 'csdheruvhhjdhvjadmvjehrve',
    'username' => 'Company name',
    'isLive' => false, // ie. sandbox mode
]);

$response = $swahilies->payments()->request([
    // TZS by default
    'amount' => 50000,
    // 255 is country code for Tanzania, Only Tanzania is supported for now
    'orderId' => $order->id,
    'phoneNumber' => "255783262616",
    'cancelUrl' => "https://yoursite.com/cancel",
    'webhookUrl' => "https://yoursite.com/response",
    'successUrl' => "https://yoursite.com/success",
    'metadata' => [],
]);

print_r($response);

// Output:
// [
//     "payment_url" => "https://swahiliespay.invict.site/make-payment-1.html?order=jdhvjadmvjehrve"
// ]


// Webhooks
// You can use the following code to verify the webhook signature

$requestBody = /** get the request body from the webhook request **/;

$isValid = $swahilies->webhooks()
    ->verify($request->getContent()); // true/false
```

## Available APIs

### Payments

-   `all()` - Get all transactions
-   `directPush($data)` - Make a direct push USSD from your app
-   `create($data)` - Make transaction
-   `request($data)` alias to `create`
-   `find($id)` - Get transaction status

### Webhooks

> 🚧 Work in progress

-   `getDisget($data)` - Generate requery body digest
-   `verify($data)` - Verify request body

## Testing

Using [PestPHP](https://pestphp.com/)

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/alphaolomi/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Alpha Olomi](https://github.com/alphaolomi)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
