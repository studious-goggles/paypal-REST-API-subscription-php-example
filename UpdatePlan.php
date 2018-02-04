<?php
$thispage = 'pp-updateplan';
$pagetitle = 'Update Plan';
$pagedescription = 'Updates a created plan to active and returns plan information. Use Plan ID in subscribe.php.';

// # Update a 'created' plan to 'active'
$createdPlan = require 'CreatePlan.php';

use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\Plan;
use PayPal\Common\PayPalModel;

try {
   $patch = new Patch();

   $value = new PayPalModel('{
      "state":"ACTIVE"
	}');

   $patch->setOp('replace')
      ->setPath('/')
      ->setValue($value);
   $patchRequest = new PatchRequest();
   $patchRequest->addPatch($patch);

   $createdPlan->update($patchRequest, $apiContext);

   $plan = Plan::get($createdPlan->getId(), $apiContext);
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
