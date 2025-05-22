<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

include('../inc/config.php');
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}



if (isset($_POST['btnbook'])) {
   
    $id = $_POST['hidid'];

//get capacity from places
$stmt = $dbh->query("SELECT * FROM places where id='$id'");
$row = $stmt->fetch();
$capacity=$row['capacity'];  

//count capacity from booking


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome - Tourist Center Booking System</title>
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
    <style type="text/css">
<!--
.style1 {font-size: 16px}
.style2 {font-size: 14px}
-->
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


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/tinapa3-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tinapa free Trade Zone</h4>
                            <h1 class="display-3 text-white mb-md-4">Let's Discover The World Together</h1>
                        </div>
                    </div>
                </div>
                
                <div class="carousel-item">
                    <img class="w-100" src="img/national park.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">National Park</h4>
                            <h1 class="display-3 text-white mb-md-4">Discover Amazing Places With Us</h1>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Packages</h6>
                <h1>Tourist Centers in Calabar Municipal</h1>
            </div>

            <div class="row">

            <?php
            // Fetch places data
$sql = "SELECT * FROM places order by id ASC";
$result = $conn->query($sql);

// Check if data is available
if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
   

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="package-item bg-white mb-2">
                        <img class="img-fluid" src="../<?php  echo $row['photo']; ?>" alt="">
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Calabar</small>
                                <small class="m-0"><i class="fa fa-euro"></i>N<?php echo number_format((float) $row['amount'] ,2); ?> (Per Day)</small>
                            </div>
                            <p><a href="#" class="h5 text-decoration-none style2"><strong>
                            <?php  echo $row['name']; ?>
                            ,</strong> 
                            <?php  echo $row['address']; ?></a></p>
                            <p>&nbsp;</p>
                            <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="txtstart">Start Date:</label>
  </div>
  <input type="date" name="txtstart" id="txtstart" class="form-control txtstart" placeholder="Choose Start Date" required>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="txtend">End Date:</label>
  </div>
  <input type="date" name="txtend" id="txtend" class="form-control txtend" placeholder="Choose End Date" required>
</div>
     <input type="hidden" id="hidamount" name="hidamount" value="<?php  echo $row['amount']; ?>">
     <input type="hidden" id="hidid" name="hidid" value="<?php  echo $row['id']; ?>" >

<div class="border-top mt-4 pt-1">
  <div class="d-flex justify-content-between">
  <h5 class="m-0 style1" id="total">Total- N0</h5>
    <p class="m-0">&nbsp;</p>
    <p class="m-0 days"></p>
  </div>
</div>
                            <div>
                                    <button name="btnbook" class="btn btn-primary btn-block py-3" type="submit">Book</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        }
      } else {
        echo "0 results";
      }
      
      $conn->close();
      ?>
            </div>

           
        </div>
</div>
    <!-- Packages End -->


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

<script>

// Get all input fields and paragraph elements
const txtstartFields = document.querySelectorAll('.txtstart');
const txtendFields = document.querySelectorAll('.txtend');
const daysElements = document.querySelectorAll('.days');
const amountElements = document.querySelectorAll('#hidamount');
const totalElements = document.querySelectorAll('#total');

// Add an event listener to each txtend input field
txtendFields.forEach((txtendField, index) => {
  txtendField.addEventListener('change', () => {
    // Get the values of the input fields
    const startDate = new Date(txtstartFields[index].value);
    const endDate = new Date(txtendField.value);

    // Check if both dates are valid
    if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
      // Calculate the difference between the two dates in days
      const differenceInDays = Math.round((endDate - startDate) / (1000 * 3600 * 24));

      // Update the corresponding #days paragraph with the calculated difference
      daysElements[index].textContent = `Duration: ${differenceInDays} Day(s)`;

      // Get the amount from the hidden field
      const amount = amountElements[index].value;

      // Calculate the total
      const total = parseFloat(amount) * differenceInDays;

      // Update the total element with the calculated total
      totalElements[index].textContent = `Total: N${total.toLocaleString()}`;

    } else {
      // Clear the corresponding #days paragraph if either date is invalid
      daysElements[index].textContent = '';
      document.getElementById("total").innerHTML = '';
    }
  });
});
</script>
 
</body>

</html>