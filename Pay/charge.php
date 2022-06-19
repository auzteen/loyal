<?php
@ob_start();
session_start();

$name = $_POST["name"];     // name to be used for email function
$email = $_POST["email"];   // email address 
$amount = $_POST["amount"]; // assume posting exchange rate on Eth 
$rewards = $amount * 0.0000001;  // Rewards point ($100 => 0.00001ETH)
$currency = $_POST["currency"]; //currency value
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

//<!----------- wallet id ---------->
$public = '<input id="public" name="public" type="text" hidden>';
$private = '<input id="private" name="private" type="text" hidden>';
 
// ------ Generate login id ------------->
$password = bin2hex(random_bytes(9));

// ----- post to database -------------->
require_once('dbo.php');
$query = "INSERT INTO transactions (name, email, amount, currency, ref_id, wallet, private_key ) VALUES ('$name', '$email', '$amount', '$currency', '$ref_id', '$wallet', '$privatekey')";
$conn->query($query) or die ("invalid user insert" . $conn->error);

$querys = "INSERT INTO user (name, email, password ) VALUES ('$name', '$email', '$password')";
$conn->query($querys) or die ("invalid user insert" . $conn->error);

// -------- Send email --------------->
 $subject = "LOYAL Wallet";
  // Content-Type helps email client to parse file as HTML
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  // More headers
$headers .= 'From: <no-reply@loyalrewards.com>' . "\r\n";
$message = "
  <html>
  <head>
  <title>Loyal Rewards</title>
  </head>
  <body>
  <p> Dear ".$name.",</p>
  <br></br>
  <p> Your order had been received. The amount of ".$amount." ".$currency." had been received. </p>
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
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">      
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.3.5/web3.min.js"></script>    
            <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
<style>
*{
  box-sizing:border-box;
 /* outline:1px solid ;*/
}
body{
background: #ffffff;
background: linear-gradient(to bottom, #ffffff 0%,#e1e8ed 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e1e8ed',GradientType=0 );
    height: 100%;
        margin: 0;
        background-repeat: no-repeat;
        background-attachment: fixed;
}
	
.wrapper-1{
  width:100%;
  height:100vh;
  display: flex;
flex-direction: column;
}
.wrapper-2{
  padding :30px;
  text-align:center;
}
h1{
    font-family: 'Kaushan Script', cursive;
  font-size:4em;
  letter-spacing:3px;
  color:#5892FF ;
  margin:0;
  margin-bottom:20px;
}
.wrapper-2 p{
  margin:0;
  font-size:1.3em;
  color:#aaa;
  font-family: 'Source Sans Pro', sans-serif;
  letter-spacing:1px;
}
.go-home{
  color:#fff;
  background:#5892FF;
  border:none;
  padding:10px 50px;
  margin:30px 0;
  border-radius:30px;
  text-transform:capitalize;
  box-shadow: 0 10px 16px 1px rgba(174, 199, 251, 1);
}
.footer-like{
  margin-top: auto; 
  background:#D7E6FE;
  padding:6px;
  text-align:center;
}
.footer-like p{
  margin:0;
  padding:4px;
  color:#5892FF;
  font-family: 'Source Sans Pro', sans-serif;
  letter-spacing:1px;
}
.footer-like p a{
  text-decoration:none;
  color:#5892FF;
  font-weight:600;
}

@media (min-width:360px){
  h1{
    font-size:4.5em;
  }
  .go-home{
    margin-bottom:20px;
  }
}

@media (min-width:600px){
  .content{
  max-width:1000px;
  margin:0 auto;
}
  .wrapper-1{
  height: initial;
  max-width:620px;
  margin:0 auto;
  margin-top:50px;
  box-shadow: 4px 8px 40px 8px rgba(88, 146, 255, 0.2);
}
  
}
</style>
	
<!-------- Generate wallet address -------->
<script>
$(function() {
    var web3 = new Web3('https://ropsten.infura.io/v3/344ac3c3c1db407c8a436d460dae20c2');   //ropsten network | mainnet network
    Promise.resolve(web3.eth.accounts.create(web3.utils.randomHex(32)))
        .then(function(value) {
            $("#public").text(value.address);
            $("#private").text(value.privateKey.substring(2));
        });
});
</script>  
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

<span class="font-weight-bold" id="public" hidden> </span>
<span class="font-weight-bold" id="private" hidden> </span>
	
<!------- Send transaction   ----->
  
</body>
</html>
