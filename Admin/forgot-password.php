<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

include('../inc/config.php');
if (empty($_SESSION['login_username'])) {
    header("Location: login.php");
}



if(isset($_POST['btn_forgot']))
{
$password = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);
 $text_email=$_POST['txtemail'];

$sql = "SELECT * FROM admin where email ='".$text_email."' " ;
$ans = $conn->query($sql);
$res=mysqli_fetch_array($ans);
   $realemail=$res['email'];
  $fullname=$res['fullname'];
  $username = $res['username'];


if($text_email == $realemail){
$sql2 = "UPDATE admin SET password ='$otp' WHERE email='$text_email'";
$ans1 = $conn->query($sql2);
 if ($ans1){
 //if (mysqli_query($conn, $ans1)) {

//send New Password  via email
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.pereztelecoms.ng';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'support@pereztelecoms.ng';                     //SMTP username
    $mail->Password   = 'Gemsworld@@##55';                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
     $mail->Port       = 465;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

   //Recipients
   $mail->setFrom($email_website, $sitename);
   $mail->addAddress($realemail,$personname);     //Add a recipient

    $message = "
    <html>
    <head>
    <title>Forgot Password |'.$sitename.'</title>
    </head>
    <body>
    <img height='90' src=\"https://www.pereztelecoms.ng/uploadImage/Logo/logo.png\" width='108'>
<p><strong>Hello,$personname</strong></p>

<p> Your Password has been recovered successfully. </p>
<p> New password is :$password  .</p>


<p> Regards.</p>
<p>$sitename</p>
    </body>
    </html>
    ";

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forgot Password |'.$sitename.'';
    $mail->Body    = $message;

    $mail->send();
  } catch (Exception $e) {
    $_SESSION['error'] ='Password could not be sent.';
}
  header("Location: login.php");

		}else{
//$_SESSION['error']='Editing Was Not Successful';
?>
<script>
alert.window("Problem Retrieving Password");
</script>
	<?php
		}
		}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Forgot Password| <?php echo $sitename ;?> </title>
  <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo;?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><img src="images/logo.svg" alt="logo" width="145" height="73"></a>  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><h5></h5>
</p>
  <p class="login-box-msg"><h5></h5>
</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="txtemail" class="form-control" placeholder="Enter Email Address" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="btn_forgot" class="btn btn-primary btn-block">Request New password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="add-admin.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<link rel="stylesheet" href="popup_style.css">
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
