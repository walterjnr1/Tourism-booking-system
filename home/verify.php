<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

include('../inc/config.php');

if ($ref ="") {
header("Location:javascript://history.go(-1)");
}

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/". rawurlencode($ref),
        CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer {$secretkey}",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);

  curl_close($curl);
  //echo $response;
      $json_output = json_decode($response, true);

   $placeid = $_GET['place'];
   $ref = $_GET['reference'];
   $amount = $_GET['amount'];
   $start = $_GET['start'];
   $end = $_GET['end'];
   $user = $_SESSION['username'];


  //save payment details
    $sql = 'INSERT INTO tblpayment(user,payment_id,description,amount,payment_date,channel) VALUES(:user,:payment_id,:description,:amount,:payment_date,:channel)';
    $statement = $dbh->prepare($sql);
    $statement->execute([
        ':user'   => $user,
        ':payment_id'   => $ref,
        ':description'   => 'booking',
        ':amount'   => $amount,
         ':payment_date'   => $current_date,
         ':channel'   => 'Paystack'

        ]);

        //save booking details
        //generate booking id
        $booking_id = uniqid();
    $sql = 'INSERT INTO tblbooking(user,booking_id,place,check_in,check_out,amount,status) VALUES(:user,:booking_id,:place,:check_in,:check_out,:amount,:status)';
    $statement = $dbh->prepare($sql);
    $statement->execute([
        ':user'   => $user,
        ':booking_id'   => $booking_id,
        ':place'   => $placeid,
        ':check_in'   => $start,
         ':check_out'   => $end,
         ':amount'   => $amount,
         ':status'   => 'Approved'

        ]);


//send booking notification
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
<title>Booking Detailss | Authur Javis University</title>
</head>
<body>

<p><strong>Hello ,</strong></p>

<p>Your booking was received successfully.</p>

<p><strong>Booking ID : </strong> $booking_id</p>
<p><strong>Status : </strong> Approved</p>

<p>Regards,</p>
<p>Authur Javis University Team</p>
</body>
</html>
";

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Booking Details | Authur Javis University';
    $mail->Body = $message;
    $mail->send();

    //echo "Email sent successfully!";
} catch (Exception $e) {
    //echo 'Email could not be sent. Please try again later. ' . $e->getMessage();
    $_SESSION['error'] = 'Email could not be sent. Please try again later. ';

  }

$_SESSION['success']='Booking received Successfully...';


 header("Location: pay_report.php?place=$placeid&start=$start&end=$end&amount=$amount&ref=$ref");

?>