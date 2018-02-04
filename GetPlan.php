<?php
$thispage = 'pp-getplan';
$pagetitle = 'Get Plan';
$pagedescription = 'Billing plan details.';

require __DIR__ . '/includes/bootstrap.php';
use PayPal\Api\Plan;

$planID = 'P-123456'; // enter the ID of the plan you want to fetch

try {
   $plan = Plan::get($planID, $apiContext);
} catch (PayPalConnectionException $ex) {
   echo $ex->getCode();
   echo $ex->getData();
   die($ex);
} catch (Exception $ex) {
   die($ex);
}

require __DIR__ . '/includes/header.php';

   echo '
   <div class="container">
      <div class="row">
         <div class="col-xs-12">';

         echo '<p><strong>Plan ID: </strong>'.$plan->getId().'</p>';

         echo '<pre>'; print($plan); echo '</pre>';

         echo '
         </div>
      </div>
   </div>';

   include __DIR__ . '/includes/footer.php';

?>
