# paypal-REST-API-subscription-php-example
Full working example creating subscriptions for users in PayPal using latest REST api in PHP

## PayPal REST API flow

1. Create a Billing Plan
2. Update a Billing Plan state to Active
3. Create Billing Agreement for user using ID from Billing Plan
4. Direct user to PayPal to sign in and confirm Agreement
5. Complete subscription by Executing Agreement when user is directed back to site

## Setup Instructions

**STEP 1: Install Composer and PayPal SDK into your project folder**  
[Install Composer](https://getcomposer.org/doc/00-intro.md)  
[Install PayPal SDK](https://developer.paypal.com/docs/api/quickstart/install/)  
&ensp; Local install `cd project_folder`  
&ensp; `php composer.phar require "paypal/rest-api-sdk-php:*"`  
&ensp; Global install `composer require "paypal/rest-api-sdk-php:*"`  

*Folder structure should be as follows to ensure SDK files and include files are called correctly:*  
&ensp;&ensp; project_folder  
&ensp;&ensp;&ensp;&ensp; *composer.json*  
&ensp;&ensp;&ensp;&ensp; *composer.lock*  
&ensp;&ensp;&ensp;&ensp; *confirmation.php*  
&ensp;&ensp;&ensp;&ensp; *CreatePlan.php*  
&ensp;&ensp;&ensp;&ensp; includes  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *bootstrap.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *countryCodes.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *footer.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *GetAgreement.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *GetPlan.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *header.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *ListTransactions.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *PrintAgreement.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *ReactivateAgreement.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *results.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *SuspendAgreement.php*  
&ensp;&ensp;&ensp;&ensp; *index.php*  
&ensp;&ensp;&ensp;&ensp; *subscribe.php*  
&ensp;&ensp;&ensp;&ensp; *subscription.php*  
&ensp;&ensp;&ensp;&ensp; *success.php*  
&ensp;&ensp;&ensp;&ensp; *UpdatePlan.php*  
&ensp;&ensp;&ensp;&ensp; vendor  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; *autoload.php*  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; composer  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; paypal  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; rest-api-sdk-php  
&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; psr  

**STEP 2: Create new app in PayPal Developer**  
Log in to PayPal Developer site and under [My Apps and Credentials](https://developer.paypal.com/developer/applications/) create an app under REST API apps. Get client ID and secret key for both sandbox and live accounts and add these to includes/bootstrap.php file

**STEP 3: Create Billing Plans**  
Fill in Subscription information in CreatePlan.php, run UpdatePlan.php in browser and save Plan ID. *Note*: UpdatePlan.php must be run within project folder to set correct $baseURL.  
This step can be repeated to create multiple Billing Plans with different subscription information e.g. varying price plans.

**STEP 4: Create Billing Agreement names &amp; descriptions**  
Enter all Plan ID’s saved in Step 3, agreement names and agreement descriptions in subscribe.php switch (line 22). Create any additional buttons required for new Billing Plans in index.php.

**STEP 5: Set up database connection to save Billing Agreement output**  
Set up database connection in confirmation.php to save all agreement information (pre-saved variables all found in includes/results.php).   
The Plan ID is saved in global variable session in subscribe.php - this is the only way it can be fetched later in confirmation.php. This should be saved in a database as otherwise it’s impossible to tell which plan the user is subscribed to later.  
Agreement ID should also be saved in a database as this can be used later for the user to fetch information on their plan and to cancel/suspend/re-activate their plan later.

**STEP 6 (optional): Send confirmation email to user**  
Not provided in this release but user should be sent confirmation of their subscription, set this up in confirmation.php.

**STEP 7: Set up database connection to fetch Agreement ID**  
To use subscription.php the Agreement ID must be fetched from somewhere e.g. database set up in step 5. Currently the Agreement ID is saved in global session variable in confirmation.php - a temporary solution for testing purposes only.


## Brief description of files:

### Files for administration of plans

**_includes/bootstrap.php_** - set up file for PayPal API  
**_includes/countryCodes.php_** - array of all available countries and converts the country in the address to the correct code  
**_includes/footer.php_** and **_header.php_** - page formatting  
**_includes/results.php_** - creates individually named variables from returned object  
**_CreatePlan.php_** - creates a new Billing Plan that users can sign up to  
**_UpdatePlan.php_** - sends patch request to make Billing Plan active (can only be used once CreatePlan.php has been set up)  
**_includes/GetPlan.php_** - uses Billing Plan ID to get fetch info about a Billing Plan, need to enter a plan ID in file  
**_includes/GetAgreement.php_** - used in various files to fetch info on a Billing Agreement eg subscription.php, SuspendAgreement.php, ReactivateAgreement.php, PrintAgreement.php, ListTransactions.php  
**_includes/SuspendAgreement.php_** - suspends a Billing Agreement from subscription.php  
**_includes/ReactivateAgreement.php_** - reactivates a Billing Agreement from subscription.php  
**_includes/PrintAgreement.php_** - uses GetAgreement.php to fetch and print out info about a Billing Agreement, need to enter an Agreement ID  
**_includes/ListTransactions.php_** - shows all payments taken from user, need to enter an agreement ID

### Pages for user actions

**_index.php_** - gives user option to chose which Billing Plan to sign up to and sends name of plan via GET to subscribe.php  
**_subscribe.php?plan=planname_** - collects Billing Plan name from URL, sets up Billing Agreement accordingly, user confirms selection and continues, Billing Agreement is created on submit and user is directed to PayPal for approval  
**_confirmation.php_** - user is directed here from PayPal, Billing Agreement is executed, user is shown amount charged and transaction id, confirmation email should be sent here  
**_success.php_** - user is congratulated on successful subscription and shown options  
**_subscription.php_** - uses Billing Agreement ID to fetch information for user on their subscription, gives option to suspend or reactivate
