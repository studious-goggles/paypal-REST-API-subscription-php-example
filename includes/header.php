<!DOCTYPE html>
<html>
   <head>
   	<meta charset="utf-8">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<meta name="description" content="">
   	<meta name="author" content="">
   	<link rel="icon" href="../../Ezyvee/images/favicon.ico">
   	<title><?php echo 'Company | '.$pagetitle; ?></title>

   	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
      <script src="https://www.paypalobjects.com/api/checkout.js"></script><!-- to render paypal button -->
   </head>

   <body id="body">

      <!--============ INTRO ============-->

      <div class="container-fluid">
   		<div class="row">
   			<div class="col-xs-12">
   				<h1 class="text-center">Paypal checkout</h1>
   			</div>
   		</div>
      </div>
      <hr>

      <!--========== PAGE LAYOUT ===========-->

      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <h2><?php echo $pagetitle ?></h2>
               <p><?php echo $pagedescription ?></p>
               <hr><br>
            </div>
         </div>
      </div>
