<?php

$amount = 8; // the amount to charged each month
$planName = 'Subscription Plan';
$planDescription = 'Access to ...';
$currency = 'GBP'; // set payment currency - https://developer.paypal.com/docs/integration/direct/rest/currency-codes/
// $shippingfee = 5.99; // uncomment to add shipping fee under charge models
// $setupfee = 10; // uncomment to add a set up fee

require __DIR__ . '/includes/bootstrap.php';
//use PayPal\Api\ChargeModel; // uncomment to set up charge models such as shipping cost
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;

// Create a new instance of Plan object
$plan = new Plan();
// # Basic Information
$plan->setName($planName)
   ->setDescription($planDescription)
   ->setType('infinite'); // set this to infinite and setCyles (below) to '0' for the plan to have no end date

// # Payment definitions for this billing plan.
$paymentDefinition = new PaymentDefinition();
$paymentDefinition->setName('Regular Payments')
   ->setType('REGULAR') // TRIAL or REGULAR
   ->setFrequency('Month') // WEEK, DAY, YEAR, MONTH
   ->setFrequencyInterval('1') // how frequently customer should be charged
   ->setCycles('0') // number of cycles in payment definition
   ->setAmount(new Currency(array('value' => $amount, 'currency' => $currency)));

/* Charge Models // uncomment to set up charge models
$chargeModel = new ChargeModel();
$chargeModel->setType('SHIPPING')
    ->setAmount(new Currency(array('value' => $shippingfee, 'currency' => $currency)));

$paymentDefinition->setChargeModels(array($chargeModel));
*/

$merchantPreferences = new MerchantPreferences();
$baseUrl = getBaseUrl();
$merchantPreferences->setReturnUrl("$baseUrl/confirmation.php?success=true")
   ->setCancelUrl("$baseUrl/confirmation.php?success=false")
   ->setAutoBillAmount('yes')
   ->setInitialFailAmountAction('CONTINUE')
   ->setMaxFailAttempts('0');
//   ->setSetupFee(new Currency(array('value' => $setupfee, 'currency' => $currency))); // uncomment to add a set up fee

$plan->setPaymentDefinitions(array($paymentDefinition));
$plan->setMerchantPreferences($merchantPreferences);

// ### Create Plan
try {
   $output = $plan->create($apiContext);
} catch (PayPalConnectionException $ex) {
   echo $ex->getCode();
   echo $ex->getData();
   die($ex);
} catch (Exception $ex) {
   die($ex);
}

return $output;


?>
