<?php
$thispage = 'pp-subscription';
$pagetitle = 'My subscription';
$pagedescription = 'Fetch users agreement details, including URLs to suspend and cancel agreement.';

// set up database connection to collect agreement ID for user

// $agreementID = 'I-123345'; // collect agreement ID from database or wherever saved

$agreementID = $_SESSION['agreementID']; // temporary solution - agreement ID should be collected from a database

require __DIR__ . '/includes/bootstrap.php';
use PayPal\Api\Agreement;

try {
    $agreement = Agreement::get($agreementID, $apiContext);
} catch (PayPalConnectionException $ex) {
   echo $ex->getCode();
   echo $ex->getData();
   die($ex);
} catch (Exception $ex) {
   die($ex);
}

// convert json object to array and fetch agreement details from results.php
$result = json_decode($agreement, true);
require __DIR__ . '/includes/results.php';

require __DIR__ . '/includes/header.php';

   echo '
   <div class="container">
      <div class="row">

         <div class="col-xs-12">
            <h4 class="text-uppercase">Subscription Information</h4>
            <hr>
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
               <strong>Last payment date: </strong>'.$lastBillingDateString.'<br>
            </p>
            <p>
               <strong>Cancel link: </strong>'.$cancelLink.'<br>
               <strong>Suspend link: </strong>'.$suspendLink.'<br>
               <strong>Re-activate link: </strong>'.$reactivateLink.'<br>
            </p>
            <br>
         </div>

      </div>
   </div>';

   include __DIR__ . '/includes/footer.php';


?>
