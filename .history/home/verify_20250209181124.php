<?php
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
         ':status'   => 'Ok'

        ]);

 header("Location: pay_report.php?place=$placeid&start=$start&end=$end&amount=$amount&ref=$ref");

?>