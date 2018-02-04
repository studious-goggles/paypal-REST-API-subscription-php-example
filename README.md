# paypal-REST-API-subscription-php-example
<p>Full working example creating subscriptions for users in PayPal using latest REST api in PHP</p>

<h2>PayPal REST API flow</h2>

<ol>
  <li>Create a Billing Plan</li>
  <li>Update a Billing Plan state to Active</li>
  <li>Create Billing Agreement for user using ID from Billing Plan</li>
  <li>Direct user to PayPal to sign in and confirm Agreement</li>
  <li>Complete subscription by Executing Agreement when user is directed back to site</li>
</ol>

<h2>Setup Instructions</h2>

<p><strong>STEP 1: Install Composer and PayPal SDK into your project folder</strong><br>
Install Composer - https://getcomposer.org/doc/00-intro.md <br>
Install PayPal SDK - https://developer.paypal.com/docs/api/quickstart/install/
</p>

<p><strong>STEP 2: Create new app in PayPal Developer</strong><br>
Log in to PayPal Developer site and under My Apps and Credentials (https://developer.paypal.com/developer/applications/) create an app under REST API apps. Get client ID and secret key for both sandbox and live accounts and add these to includes/bootstrap.php file
</p>

<p><strong>STEP 3: Create Billing Plans</strong><br>
Fill in Subscription information in CreatePlan.php, run UpdatePlan.php in browser and save Plan ID. Note: UpdatePlan.php must be run within project folder to set correct $baseURL.<br>
This step can be repeated to create multiple Billing Plans with different subscription information e.g. varying price plans.
</p>

<p><strong>STEP 4: Create Billing Agreement names &amp; descriptions</strong><br>
Enter all Plan ID’s saved in Step 3, agreement names and agreement descriptions in subscribe.php switch (line 22). Create any additional buttons required for new Billing Plans in index.php.
</p>

<p><strong>STEP 5: Set up database connection to save Billing Agreement output</strong><br>
Set up database connection in confirmation.php to save all agreement information (pre-saved variables all found in includes/results.php). <br>
The Plan ID is saved in global variable session in subscribe.php - this is the only way it can be fetched later in confirmation.php. This should be saved in a database as otherwise it’s impossible to tell which plan the user is subscribed to later.<br>
Agreement ID should also be saved in a database as this can be used later for the user to fetch information on their plan and to cancel/suspend/re-activate their plan later.
</p>

<p><strong>STEP 6 (optional): Send confirmation email to user </strong><br>
Not provided in this release but user should be sent confirmation of their subscription, set this up in confirmation.php.
</p>

<p><strong>STEP 7: Set up database connection to fetch Agreement ID</strong><br>
To use subscription.php the Agreement ID must be fetched from somewhere e.g. database set up in step 5. Currently the Agreement ID is saved in global session variable in confirmation.php - a temporary solution for testing purposes only.
</p>


<h2>Brief description of files:</h2>

<h3>Admin files</h3>

<p><i>CreatePlan.php</i> - creates a new Billing Plan that users can sign up to</p>

<p><i>UpdatePlan.php</i> - sends patch request to make Billing Plan active (can only be used once CreatePlan.php has been set up)</p>

<p><i>GetPlan.php</i> - uses Billing Plan ID to get fetch info about a Billing Plan</p>


<h3>For user</h3>

<p><i>index.php</i> - gives user option to chose which Billing Plan to sign up to and sends name of plan via GET to subscribe.php</p>

<p><i>subscribe.php?plan=planname</i> - collects Billing Plan name from URL, sets up Billing Agreement accordingly, user confirms selection and continues, Billing Agreement is created on submit and user is directed to PayPal for approval</p>

<p><i>confirmation.php</i> - user is directed here from PayPal, Billing Agreement is executed, user is shown amount charged and transaction id, confirmation email should be sent here</p>

<p><i>success.php</i> - user is congratulated on successful subscription and shown options</p>

<p><i>subscription.php</i> - uses Billing Agreement ID to fetch information for user on their subscription</p>
