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
      "Authorization: Bearer sk_test_47baa9aaab29e730ccc5d25c1f00761454fc58e4",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);

  curl_close($curl);
  //echo $response;
      $json_output = json_decode($response, true);

   $placeid = $_GET['placeid'];
   $ref = $_GET['reference'];
   $amount = $_GET['amount'];
   $start = $_GET['start'];
   $end = $_GET['end'];
   $user = $_SESSION['username'];


  //save payment details
    $sql = 'INSERT INTO tblpayment(user,payment_id,description,amount,payment_date,channel) VALUES(user:,:payment_id,:amount,:phone,:email,:purpose,:payment_date,:school_session)';
    $statement = $dbh->prepare($sql);
    $statement->execute([
        ':user'   => $user,
        ':payment_id'   => $ref,
        ':description'   => 'booking',
        ':amount'   => $amount,
         ':payment_date'   => $current_date,
         ':channel'   => 'Paystack'

        ]);

//update student status
$sql_status = " update tblstudents set status='1' where admission_no='$admissionno'";
if (mysqli_query($conn, $sql_status)) {

  $_SESSION['payment_ref']=$ref;

 header("Location: pay_success_admissionfee.php");
}
?>