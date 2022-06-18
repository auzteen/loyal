<?php
@ob_start();
	session_start();

$name = $_POST["name"];     // name to be used for email function
$email = $_POST["email"];   // email address 
$amounts = $_POST["amount"]; // assume posting exchange rate on Eth 
$amount = $amounts * 100;   // value in cents for payments
$currency = $_POST["currency"]; //currency value

?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Loyal</title>
	<link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/pay.css">
	<script src="https://js.stripe.com/v3/"></script>
</head>

<body>
	<div id="wrapper">
		<div class="container">
			<div class="row py-5">
				<button type="button" class="btn btn-primary p-3 text-center m-auto d-block w-25" data-bs-toggle="modal" data-bs-target="#exampleModal">Payment</button>
			</div>
		</div>
	</div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
				<div class="modal-body">
					<h1 class="text-center mb-4 fs-1 fw-bold">LOYAL</h1>
					<div class="bg-white shadow-sm">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item">
								<a data-toggle="pill" href="#credit-card" class="nav-link active fw-bold"> 
									<i class="fa fa-credit-card me-2"></i>Pay With Card
								</a> 
							</li>
                            <li class="nav-item">
								<a data-toggle="pill" href="#crypto" class="nav-link fw-bold"> 
									<i class="fab fa-ethereum me-2"></i>Pay With Crypto
								</a> 
							</li>
                        </ul>
                    </div>
					<div class="tab-content">
						<div id="credit-card" class="tab-pane fade show active pt-3">
						<p> <?php echo $amounts; ?> <?php echo $currency; ?> </p>
						
<form action="charge.php" method="post" id="payment-form">
    <input type="hidden" name="token" />
	<input type="hidden" name="name" id="name" value="<?php echo $name ?>"/>
	<input type="hidden" name="email" id="email" value="<?php echo $email ?>"/>
    <input type="hidden" name="amount" id="amount" value="<?php echo $amount ?>"/>
    <input type="hidden" name="currency" id="currency" value="<?php echo $currency ?>" />
   
    <form role="form">
	<div class="form-group mb-3"> 
	   <label for="username" class="form-label fw-bold">Card Owner:<em>*</em></label> 
	    <input type="text" name="username" id="username" placeholder="Card Owner Name" class="form-control" value="<?php echo $name; ?>" disabled> 
	</div>
	<div class="form-group mb-3"> 
		<label for="cardNumber"  class="form-label fw-bold">Card Number:<em>*</em></label>
		<div class="input-group"> 
		<input type="text" name="emails" id="emails" placeholder="Valid card number" class="form-control" value="<?php echo $email; ?>" disabled>
		</div>
	</div>

    <div class="group">
	<label for="cardNumber"  class="form-label fw-bold">Card:<em>*</em></label>
        <div id="card-element" class="field"></div>
    </div>
   											
					<!--		<div class="row mb-4">
									<div class="col-sm-8">
										<div class="form-group"> 
											<label class="form-label fw-bold">Expiration Date:<em>*</em></label>
											<div class="input-group"> 
												<input type="number" placeholder="MM" name="mm" id="mm" class="form-control" required> 
												<input type="number" placeholder="YY" name="yy" id="yy" class="form-control" required> 
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group"> 
											<label data-toggle="tooltip" title="Three digit CV code on the back of your card" class="form-label fw-bold">CVV: <i class="fa fa-question-circle d-inline"></i></label> 
											<input type="text" name="cvv" id="cvv" required class="form-control"> 
										</div>
									</div>
								</div> -->
	<button type="submit" class="btn btn-primary p-3 text-center m-auto d-block">Send Payment </button>
</form> 

						</div>
						<div id="crypto" class="tab-pane fade pt-3">
							<ul role="tablist" class="nav nav-pills rounded nav-fill crypto_payment">
								<li class="nav-item">
									<a data-toggle="pill" href="#qr" class="nav-link active fw-bold"> 
										Pay With QR  
									</a> 
								</li>
								<li class="nav-item">
									<a data-toggle="pill" href="#wallet" class="nav-link fw-bold"> 
										Pay With Wallet
									</a> 
								</li>
							</ul>
							<div class="tab-content">
								<div id="qr" class="tab-pane fade show active pt-3">
									<form role="form">
										<img src="images/qr_code.png" class="img-fluid text-center m-auto d-block mb-4" /> 
										<button type="submit" class="btn btn-primary p-3 text-center m-auto d-block">Send Payment</button>
									</form>
								</div>
								<div id="wallet" class="tab-pane fade pt-3">
									<form role="form">
										<div class="form-group mb-3"> 
											<label for="username" class="form-label fw-bold">Source Wallet:<em>*</em></label> 
											<input type="text" name="username" placeholder="Source Wallet" class="form-control" required> 
										</div>
										<div class="form-group mb-3"> 
											<label for="username" class="form-label fw-bold">Receipient Wallet:<em>*</em></label> 
											<input type="text" name="username" placeholder="Receipient Wallet" class="form-control" required> 
										</div>
										<button type="submit" class="btn btn-primary p-3 text-center m-auto d-block">Send Payment</button>
									</form>

								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
        </div>
     </div>


<script>
var stripe = Stripe('pk_test_EMQANyPPBiHQLW4Qns8kJQNM');
var elements = stripe.elements();

var card = elements.create('card', {
  hidePostalCode: true,
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: 'Helvetica Neue',
      fontSize: '15px',

      '::placeholder': {
        color: '#CFD7E0',
      },
    },
  }
});
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            stripeTokenHandler(result.token);
        }
    });
});
// Send Stripe Token to Server
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
// Add Stripe Token to hidden input
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
// Submit form
    form.submit();
}

</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
</body>
</html>