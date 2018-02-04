<?php
$thispage = 'pp-priceplans';
$pagetitle = 'Priceplans';
$pagedescription = 'Select your preferred priceplan.';

require __DIR__ . '/includes/header.php';

   echo '
   <div class="container">
      <div class="row">
         <div class="col-xs-12">';

            echo '<div id="paypal-button"></div>';

            // use GET variable to send name of plan to subscribe.php
            echo '<p><a href="subscribe.php?plan=plan1" class="btn btn-default">Plan One</a></p>';

            echo '<p><a href="subscribe.php?plan=plan2" class="btn btn-default">Plan Two</a></p>';

         echo '
         </div>
      </div>
   </div>';

   include __DIR__ . '/includes/footer.php';

   ?>
