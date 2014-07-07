<?php

require_once '/home/bridget/braintree-php-2.27.2/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('pxjknn5sr7xpw779');
Braintree_Configuration::publicKey('nxmnjtjfj2hn8xky');
Braintree_Configuration::privateKey('954afde50d7e27c41616f60b93f7ddeb');

$result = Braintree_Transaction::sale(array(
	"amount" => "1000.00",
	"creditCard" => array(
		"number" => $_POST["number"],
		"cvv" => $_POST["cvv"]
		"expirationMonth" => $_POST["month"]
		"expirationYear" => $_POST["year"]
	),
	"options" => array(
		"submitForSettlement" => true
	)
));

if ($result->success) {
	echo("Success! Transaction ID: " . $result->transaction->id);
} else if ($result->transaction) {
	echo("Error: " . $result->message);
	echo("<br/>");
	echo("Code: " . $result->transaction->processorResponseCode);
} else {
	echo("Validation errors:<br/>");
	foreach (($result->errors->deepAll()) as $error) {
		echo("- " . $error->message . "<br/>";
	}
}
?>
