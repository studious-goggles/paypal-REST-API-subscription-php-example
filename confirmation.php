<?php
$thispage = 'pp-confirmation';
$pagetitle = 'Confirmation';
$pagedescription = 'Agreement has been executed, agreement details are displayed to user, confirmation email sent, user continues to sucess page.';
// http://mysite/confirmation.php?success=true&token=EC-5PU33157KX1444400
// http://localhost/paypal/confirmation.php?success=true&token=EC-7VH54902DY2137516

require __DIR__ . '/includes/bootstrap.php';
use PayPal\Api\Agreement;

if (isset($_GET['token'])) {

   // collect token from URL
   $token = $_GET['token'];

   // Execute the agreement by passing in the token
   $agreement = new Agreement();
   try {
      $agreement->execute($token, $apiContext);
   } catch (PayPalConnectionException $ex) {
      echo $ex->getCode();
      echo $ex->getData();
      die($ex);
   } catch (Exception $ex) {
      die($ex);
   }


   // convert json object to array and fetch agreement details from results.php (including agreement id)
   $result = json_decode($agreement, true);
   require __DIR__ . '/includes/results.php';


   // save all details to database now or use webhook - https://developer.paypal.com/docs/api/webhooks/
   $_SESSION['agreementID'] = $agreementID; // temporary solution to save agreement ID so can be used in subscription.php

   // send email confirmation to user

}

require __DIR__ . '/includes/header.php';

   echo '
   <div class="container">
      <div class="row">';

      // success variable in URL set in createplan.php to show successful completion of payment
      if(isset($_GET['success']) && $_GET['success'] == 'true') {

         echo '
         <div class="col-xs-12">
            <h3>Thanks for your order, your subscription is set up</h3><br>
         </div>

         <div class="col-xs-12 col-sm-6">
            <h4 class="text-uppercase">Payment Information</h4>
            <hr>
            <p>
               <strong>Plan ID: </strong>'.$_SESSION['planID'].'<br>
            </p>
            <p>
               <strong>Agreement ID: </strong>'.$agreementID.'<br>
               <strong>Subscription state: </strong>'.$state.'<br>
            </p>
            <p>
               <strong>Subscription plan: </strong>'.$paymentValue.' '.$paymentCurrency.' / '.$paymentFrequency.'
            </p>
            <p>
               <strong>Start date: </strong>'.$startDateString.'<br>
               <strong>Next payment date: </strong>'.$nextBillingDateString.'<br>
            </p>
            <br>
         </div>

         <div class="col-xs-12 col-sm-6">
            <h4 class="text-uppercase">Your Information</h4>
            <hr>
            <p>
               <strong>Payer ID: </strong>'.$payerID.'<br>
            </p>
            <p><strong>Email: </strong>'.$email.'</p>
            <p>
               <strong>Billing Address: </strong><br>'.
               $shippingAddressName.'<br>'.
               $shippingAddress1.'<br>'.
               $shippingAddressCity.'<br>'.
               $shippingAddressState.'<br>'.
               $shippingAddressPostcode.'<br>'.
               $shippingAddressCountryCode.'<br>
            </p>
            <a href="success.php" class="btn btn-default pull-right">Continue</a>
         </div>';

      } elseif(isset($_GET['success']) && $_GET['success'] == 'false') {

         echo '
         <div class="col-xs-12">
            <p>PayPal checkout has been cancelled, no subscription has been set up and no payment has been taken. If you want to set up a new subscription please <a href="priceplans.php">go back to priceplans</a> and select a plan. If you\'re having problems subscribing to a plan please <a href="contact.php">contact us</a> for help.</p>
         </div>';

      }

      echo '
      </div>
   </div>';

   include __DIR__ . '/includes/footer.php';


?>
