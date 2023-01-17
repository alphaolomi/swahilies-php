# Accept payments

Receive fast and secure payments with SwahiliesPay inn your PHP application.

## Create Payment Request(Checkout Order)

Create a Payment Request(Checkout Order) from your Site/App and redirect the user to the payment page.

Example:
```php
use Alphaolomi\Swahilies\Swahilies;

$swahilies = new Swahilies([
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
```

Redirect the user to the payment page using the `payment_url` from the response.

## Get Paymennt/Order Status

Get the status of a payment/order.

Example:
```php
use Alphaolomi\Swahilies\Swahilies;

$swahilies = Swahilies::create([
    'apiKey' => 'csdheruvhhjdhvjadmvjehrve',
    'username' => 'Company name',
    'isLive' => false, // ie. sandbox mode
]);

$id = 'jdhvjadmvjehrve'; 

$orderData = $swahilies->payments()->find($id);

print_r($response);
```
