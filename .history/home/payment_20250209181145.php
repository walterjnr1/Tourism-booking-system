<?php

include('../inc/config.php');
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}

$placeid=$_GET['place'];
$amount=$_GET['amount'];
$start=$_GET['start'];
$end=$_GET['end'];




//get number of days from start and end
$start_date = new DateTime($start);
$end_date = new DateTime($end);

//get number of days from start and end
$days = $start_date->diff($end_date)->days;

$total = $days* $amount;

//get place from placeid
$stmt = $dbh->query("SELECT * FROM places where id='$placeid'");
$row = $stmt->fetch();
$place=$row['name'];  
$address=$row['address'];  


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Payment - <?php echo $sitename ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo;?>">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
<style>
    #payment {
    margin: 0 auto;
    width: 80%; /* or any other width you want */
}
.style1 {color: #000000}
</style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-envelope mr-2"></i>support@bookings.com</p>
                        <p class="text-body px-3">|</p>
                        <p><i class="fa fa-phone-alt mr-2"></i><?php echo $phone?></p>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-primary pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h5 class="m-0 text-primary"><span class="text-dark"><?php echo $sitename?></span>(<?php echo $_SESSION["name"]?>)</h5>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="logout.php" class="nav-item nav-link">Logout</a>

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Payment</h6>
                <h1>Start Payment</h1>
            </div>
            <form action="" method="POST" form id="paymentForm">

            <div class="row justify-content-center" id="payment">
                <div class="col-lg-8 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <h5 class="mb-2">Paystack</h5>
                        
                        <p align="justify" class="m-0"><span class="style1">Place   :</span><?php echo $place; ?>, <?php echo $address; ?></p>
                        <p align="justify" class="m-0"><span class="style1">Total  :</span>N<?php echo number_format((float) $total ,2); ?></p>
                        <p align="justify" class="m-0"><span class="style1">Duration: </span><?php echo $days; ?>day(s) , Starting From: <?php echo $start; ?></p>
                        

                        
                        <button class="btn btn-primary py-3 px-4" type="submit" name="btnpay" onClick="payPageWithPaystack()">Pay Now</button>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="hidpublickey" name="hidpublickey" value="<?php echo $publickey; ?>"> </p>
    <input type="hidden" id="hidemail" name="hidemail" value="<?php echo $_SESSION['email']; ?>"> </p>
    <input type="hidden" id="hidtotal" name="hidtotal" value="<?php echo $total; ?>"> </p>
    <input type="hidden" id="hidplace" name="hidplace" value="<?php echo $placeid; ?>"> </p>
    <input type="hidden" id="hidstart" name="hidstart" value="<?php echo $start; ?>"> </p>
    <input type="hidden" id="hidend" name="hidend" value="<?php echo $end; ?>"> </p>

                    <script src="https://js.paystack.co/v1/inline.js"></script>
				  <script>
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: document.getElementById("hidpublickey").value, // Replace with your public key
    email: document.getElementById("hidemail").value,
    amount: document.getElementById("hidtotal").value * 100,
    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars

    ref: Math.floor((Math.random() * 10000000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
        window.location="http://localhost/tourism_booking_system/home/payment.php?transaction=Cancelled";
      alert('Transaction Cancelled.');
    },
       callback: function(response){
      let message = 'Booking Payment complete! Reference: ' + response.reference + ' . Kindly save the reference ID for future use.';
    alert(message);
    window.location="http://localhost/tourism_booking_system/home/verify.php?amount="+encodeURIComponent(document.getElementById("hidtotal").value)+"&email=" +encodeURIComponent(document.getElementById("hidemail").value)+"&place=" +encodeURIComponent(document.getElementById("hidplace").value)+"&start=" +encodeURIComponent(document.getElementById("hidstart").value)+"&end=" +encodeURIComponent(document.getElementById("hidend").value)+"&reference=" + response.reference    }
  });

  handler.openIframe();
}
    </script> 


      <!-- Footer Start -->
    
      <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <?php echo date("Y")?>. All Rights Reserved.</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <p class="m-0 text-white-50">Designed by Collins Emeka | 20010101003| <?php echo $sitename; ?>.
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>