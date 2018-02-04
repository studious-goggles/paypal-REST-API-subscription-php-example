<?php

if(isset($result)) {

   if(isset($result['description'])) { $description = $result['description']; }
   if(isset($result['id'])) { $agreementID = $result['id']; }
   if(isset($result['state'])) { $state = $result['state']; }
   if(isset($result['payer']['payment_method'])) { $paymentMethod = $result['payer']['payment_method']; }
   if(isset($result['payer']['status'])) { $paymentStatus = $result['payer']['status']; }
   if(isset($result['payer']['payer_info']['email'])) { $email = $result['payer']['payer_info']['email']; }
   if(isset($result['payer']['payer_info']['first_name'])) { $firstname = $result['payer']['payer_info']['first_name']; }
   if(isset($result['payer']['payer_info']['last_name'])) { $lastname = $result['payer']['payer_info']['last_name']; }
   if(isset($result['payer']['payer_info']['payer_id'])) { $payerID = $result['payer']['payer_info']['payer_id']; }
   if(isset($result['payer']['payer_info']['shipping_address']['recipient_name'])) { $payerShippingAddressName = $result['payer']['payer_info']['shipping_address']['recipient_name']; }
   if(isset($result['payer']['payer_info']['shipping_address']['line1'])) { $payerShippingAddress1 = $result['payer']['payer_info']['shipping_address']['line1']; }
   if(isset($result['payer']['payer_info']['shipping_address']['city'])) { $payerShippingAddressCity = $result['payer']['payer_info']['shipping_address']['city']; }
   if(isset($result['payer']['payer_info']['shipping_address']['state'])) { $payerShippingAddressState = $result['payer']['payer_info']['shipping_address']['state']; }
   if(isset($result['payer']['payer_info']['shipping_address']['postal_code'])) { $payerShippingAddressPostcode = $result['payer']['payer_info']['shipping_address']['postal_code']; }
   if(isset($result['payer']['payer_info']['shipping_address']['country_code'])) { $payerShippingAddressCountryCode = $result['payer']['payer_info']['shipping_address']['country_code']; }
   if(isset($result['plan']['payment_definitions'][0]['type'])) { $paymentType = $result['plan']['payment_definitions'][0]['type']; }
   if(isset($result['plan']['payment_definitions'][0]['frequency'])) { $paymentFrequency = $result['plan']['payment_definitions'][0]['frequency']; }
   if(isset($result['plan']['payment_definitions'][0]['amount']['currency'])) {
      $paymentCurrency = $result['plan']['payment_definitions'][0]['amount']['currency'];
   }
   // in execute agreement - currency code is different in array
   elseif(isset($result['plan']['currency_code'])) {
      $paymentCurrency = $result['plan']['currency_code'];
   }
   if(isset($result['plan']['payment_definitions'][0]['amount']['value'])) { $paymentValue = $result['plan']['payment_definitions'][0]['amount']['value']; }
   if(isset($result['start_date'])) { $startDate = $result['start_date']; }
   if(isset($result['shipping_address']['recipient_name'])) { $shippingAddressName = $result['shipping_address']['recipient_name']; }
   if(isset($result['shipping_address']['line1'])) { $shippingAddress1 = $result['shipping_address']['line1']; }
   if(isset($result['shipping_address']['city'])) { $shippingAddressCity = $result['shipping_address']['city']; }
   if(isset($result['shipping_address']['state'])) { $shippingAddressState = $result['shipping_address']['state']; }
   if(isset($result['shipping_address']['postal_code'])) { $shippingAddressPostcode = $result['shipping_address']['postal_code']; }
   if(isset($result['shipping_address']['country_code'])) { $shippingAddressCountryCode = $result['shipping_address']['country_code']; }
   if(isset($result['agreement_details']['outstanding_balance']['currency'])) { $balanceCurrency = $result['agreement_details']['outstanding_balance']['currency']; }
   if(isset($result['agreement_details']['outstanding_balance']['value'])) { $balanceValue = $result['agreement_details']['outstanding_balance']['value']; }
   if(isset($result['agreement_details']['cycles_remaining'])) { $cyclesRemaining = $result['agreement_details']['cycles_remaining']; }
   if(isset($result['agreement_details']['cycles_completed'])) { $cyclesCompleted = $result['agreement_details']['cycles_completed']; }
   if(isset($result['agreement_details']['next_billing_date'])) { $nextBillingDate = $result['agreement_details']['next_billing_date']; }
   if(isset($result['agreement_details']['last_payment_date'])) { $lastBillingDate = $result['agreement_details']['last_payment_date']; }
   if(isset($result['agreement_details']['last_payment_amount']['currency'])) { $lastPaymentAmountCurrency = $result['agreement_details']['last_payment_amount']['currency']; }
   if(isset($result['agreement_details']['last_payment_amount']['value'])) { $lastPaymentAmountValue = $result['agreement_details']['last_payment_amount']['value']; }
   if(isset($result['agreement_details']['final_payment_date'])) { $finalPaymentDate = $result['agreement_details']['final_payment_date']; }
   if(isset($result['agreement_details']['failed_payment_count'])) { $failedPaymentCount = $result['agreement_details']['failed_payment_count']; }
   if(isset($result['links'][0]['href'])) { $suspendLink = $result['links'][0]['href']; }
   if(isset($result['links'][1]['href'])) { $reactivateLink = $result['links'][1]['href']; }
   if(isset($result['links'][2]['href'])) { $cancelLink = $result['links'][2]['href']; }
   if(isset($result['links'][3]['href'])) { $billBalanceLink = $result['links'][3]['href']; }
   if(isset($result['links'][4]['href'])) { $setBalanceLink = $result['links'][4]['href']; }

   // convert dates to string
   if(isset($startDate)) { $startDateString = date('d F Y', strtotime($startDate)); }
   if(isset($nextBillingDate)) { $nextBillingDateString = date('d F Y', strtotime($nextBillingDate)); }
   if(isset($lastBillingDate)) { $lastBillingDateString = date('d F Y', strtotime($lastBillingDate)); }

}


?>
