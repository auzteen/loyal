<?php
@ob_start();
session_start();

$name = $_POST["name"];     // name to be used for email function
$email = $_POST["email"];   // email address 
$amount = $_POST["amount"]; // assume posting exchange rate on Eth 
$amounts = $amount * 0.01;
$points = $amounts * 0.005;    // points ($100 => 1 pts)
$rewards = $amounts * 0.000005;  // Rewards ($100 => 0.00001ETH)
$currency = $_POST["currency"]; //currency value
$public = $_POST["publics"]; //wallet address
$private = $_POST["privates"]; //private key
?>

//<!------- post to stripe -------->
<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey("sk_test_I2bzkJK8NJRBp95BwYY1tMci");
// Get the token from the JS script
$token = $_POST['stripeToken'];
// Create a Customer
$customer = \Stripe\Customer::create(array(
    "name" => $name,
    "email" => $email,
    "source" => $token,
));
// Save the customer id in your own database!
// Charge the Customer instead of the card
$charge = \Stripe\Charge::create(array(
    "amount" => $amount,
    "currency" => $currency,
    "customer" => $customer->id
));
// You can charge the customer later by using the customer id.
 
// ------ Generate login id ------------->
$password = bin2hex(random_bytes(9));

// ----- post to database -------------->
require_once('dbo.php');
$query = "INSERT INTO transactions (name, email, amount, currency, ref_id, wallet, private_key, points, rewards, customer ) VALUES ('$name', '$email', '$amounts', '$currency', '$charge->id', '$public', '$private', '$points', '$rewards', '$customer->id')";
$conn->query($query) or die ("invalid user insert" . $conn->error);	

$querys = "INSERT INTO user (name, email, password ) VALUES ('$name', '$email', '$password')";
$conn->query($querys) or die ("invalid user insert" . $conn->error);

// -------- Send email --------------->
 $subject = "Loyal Wallet";
  // Content-Type helps email client to parse file as HTML
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  // More headers
$headers .= 'From: <no-reply@myloyal.site>' . "\r\n";
$message = "
  <html>
  <head>
  <title>Loyal Rewards</title>
  </head>
  <body>
  <p> Dear ".$name.",</p>
  <br></br>
  <p> Your order had been received. The amount of ".$amounts." ".$currency." had been received. </p>
  <b></b>
  <br></br>
  <p> You can login to https://loyalrewards.com to complete your signup and receive your reward points as crypto and you can withdraw at any time. </p>  
  <b></b>
  <br></br>
  <p></p>
  <p>Regards,</p>
  <p></p>
  <p> Loyal Team</p>
  </body>
  </html> ";
 mail($email, $subject, $message);

// -------page redirection ------>
// header("Location: post.php");

?>


<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.3.5/web3.min.js"></script>    
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">	
<link href="css/charge.css" rel="stylesheet">
</head>

<body>

<div class=content>
  <div class="wrapper-1">
    <div class="wrapper-2">
      <h1>Thank you !</h1>
      <p>Thanks for purchasing. Your order had been processed.  </p>
      <p>you should receive a confirmation email soon  </p>
    </div>
    <div class="footer-like"> </div>
  </div>
</div>

	
<!------- Send transaction   ----->
  
</body>
</html>
