<?php

require_once '../../braintree-php-2.27.2/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('pxjknn5sr7xpw779');
Braintree_Configuration::publicKey('nxmnjtjfj2hn8xky');
Braintree_Configuration::privateKey('954afde50d7e27c41616f60b93f7ddeb'); 

$result = Braintree_Transaction::sale(array(
    'amount' => '1000.00',
    'creditCard' => array(
        'number' => '4111111111111111',
	'cvv' => '111',
        'expirationMonth' => '05',
        'expirationYear' => '12'
    )
));

if ($result->success) {
    print_r("success!: " . $result->transaction->id);
} else if ($result->transaction) {
    print_r("Error processing transaction:");
    print_r("\n  message: " . $result->message);
    print_r("\n  code: " . $result->transaction->processorResponseCode);
    print_r("\n  text: " . $result->transaction->processorResponseText);
} else {
    print_r("Message: " . $result->message);
    print_r("\nValidation errors: \n");
    print_r($result->errors->deepAll());
}
