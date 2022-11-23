<?php

use Alphaolomi\Swahilies\Swahilies;

it('can instantiate Swahilies using new', function () {
    $swahilies = new Swahilies([
        'apiKey' => 'csdheruvhhjdhvjadmvjehrve',
        'username' => 'Company name',
        'username' => 'Business name',
        'isLive' => false, // ie. sandbox mode
    ]);
    expect($swahilies)->toBeTruthy();
    expect($swahilies)->toBeInstanceOf(Swahilies::class);
});

it('can instantiate Swahilies using create', function () {
    $swahilies = Swahilies::create([
        'apiKey' => 'csdheruvhhjdhvjadmvjehrve',
        'username' => 'Company name',
        'username' => 'Business name',
        'isLive' => false, // ie. sandbox mode
    ]);
    expect($swahilies)->toBeTruthy();
    expect($swahilies)->toBeInstanceOf(Swahilies::class);
});

// it('can make payments', function () {
//     $swahilies = Swahilies::create([
//         'apiKey' => "",
//         'username' => 'Tickets',
//         'username' => 'Tickets',
//         'isLive' => false, // ie. sandbox mode
//     ]);

//     expect($swahilies->payaments()->request([
//         // TZS by default
//         'amount' => 300,
//         // 255 is country code for Tanzania, Only Tanzania is supported for now
//         'phoneNumber' => "255747991498",
//         'cancelUrl' => "https://yoursite.com/cancel",
//         'webhookUrl' => "https://yoursite.com/response",
//         'successUrl' => "https://yoursite.com/success",
//         'metadata' => [],
//     ]))->dd();
// });

// it('can make payments', function () {
//     $swahilies = Swahilies::create([
//         'apiKey' => "",
//         'username' => 'Tickets',
//         'username' => 'Tickets',
//         'isLive' => false, // ie. sandbox mode
//     ]);

//     expect($swahilies->payaments()->all())->dd();
// });

// it('can make payments', function () {
//     $swahilies = Swahilies::create([
//         'apiKey' => "",
//         'username' => 'Tickets',
//         'username' => 'Tickets',
//         'isLive' => false, // ie. sandbox mode
//     ]);

//     expect($swahilies->payaments()->get('1ef3610b20de4913ad6f82b8e7e3c528'))->dd();
// });
