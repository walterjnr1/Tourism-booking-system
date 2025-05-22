<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
include('../inc/config.php');

if(isset($_POST["btnsave"]))
{

$username = mysqli_real_escape_string($conn,$_POST['txtusername']);
$name = mysqli_real_escape_string($conn,$_POST['txtname']);
$email = mysqli_real_escape_string($conn,$_POST['txtemail']);
$password = mysqli_real_escape_string($conn,$_POST['txtpassword']);
$phone = mysqli_real_escape_string($conn,$_POST['txtphone']);


 $sql = "SELECT * FROM tblusers where username='$username' or email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$_SESSION['error'] =' Username Address or Email Address already Exist ';

}elseif(strlen($password) < 8){
$_SESSION['error'] ='Password must be at least 8 characters';


}else{
//save admin details
$query = "INSERT into `tblusers` (name,username,password,email,phone)
VALUES ('$name','$username','$password','$email','$phone')";

    $result = mysqli_query($conn,$query);
      if($result){
	 

        // Send username and password via email
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'ucnewspro@gmail.com'; //SMTP username
            $mail->Password = 'qbffuhedyrxdcciw'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('support@booking.com.ng', 'Authur Javis University'); // Use a valid email address
            $mail->addAddress($email); //Add a recipient

            $message = "
<html>
<head>
<title>User Registration Details | Authur Javis University</title>
</head>
<body>

<p><strong>Hello ,</strong></p>

<p>Your admin account has been created successfully.</p>

<p><strong>Username : </strong> $username</p>
<p><strong>Password : </strong> $password</p>

<p>Regards,</p>
<p>Authur Javis University Team</p>
</body>
</html>
";

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'User Registration Details | Authur Javis University';
            $mail->Body = $message;
            $mail->send();

            //echo "Email sent successfully!";
        } catch (Exception $e) {
            //echo 'Email could not be sent. Please try again later. ' . $e->getMessage();
            $_SESSION['error'] = 'Email could not be sent. Please try again later. ';

          }

    $_SESSION['success']='User added Successfully...';

}else{
  $_SESSION['error']='Problem Adding User';

}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Signup - Tourist Center Booking System</title>
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


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Signup</h6>
                <h1>Signup</h1>
            </div>
            <div class="row justify-content-center">
              <div class="col-lg-8">
                    <div class="contact-form bg-white" style="padding: 30px;">
                        <div id="success"></div>
                        <form  action="" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="control-group col-sm-6">
                                    <input type="text" class="form-control p-4" name="txtname" placeholder="Your FullName"
                                        required="required" data-validation-required-message="Please enter your name" value="<?php if (isset($_POST['txtname']))?><?php echo $_POST['txtname']; ?>"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group col-sm-6">
                                    <input type="email" class="form-control p-4" name="txtemail" placeholder="Your Email"
                                        required="required" data-validation-required-message="Please enter your email" value="<?php if (isset($_POST['txtemail']))?><?php echo $_POST['txtemail']; ?>"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="control-group col-sm-6">
                                    <input type="text" class="form-control p-4" name="txtusername" placeholder="Your Username"
                                        required="required" data-validation-required-message="Please enter your username" value="<?php if (isset($_POST['txtusername']))?><?php echo $_POST['txtusername']; ?>"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group col-sm-6">
                                    <input type="text" class="form-control p-4" name="txtpassword" placeholder="Your Password"
                                        required="required" data-validation-required-message="Please enter your Password" value="<?php if (isset($_POST['txtpassword']))?><?php echo $_POST['txtpassword']; ?>"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control p-4" name="txtphone" placeholder="Your Phone"
                                    required="required" data-validation-required-message="Please enter Your Phone" value="<?php if (isset($_POST['txtphone']))?><?php echo $_POST['txtphone']; ?>"/>
                                <p class="help-block text-danger"></p>
                            </div>
                            
                            <div class="text-center">
                                <button class="btn btn-primary py-3 px-4" type="submit" name="btnsave">Save</button>
                            </div>
                        </form>
                    </div>
					<div align="right">Already a User?<a href="login.php"> Login here</a>                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

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
    <link rel="stylesheet" href="../Admin/popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong>
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong>
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
</body>

</html>