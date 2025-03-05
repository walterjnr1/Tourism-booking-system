<?php
 include('../inc/config.php');
if(empty($_SESSION['login_username']))
    {
      header("Location: login.php");
    } ?>

<?php
//Automatic logout
$t=time();
if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 3600)) {

	session_destroy();
    session_unset();
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Sorry , You have been Logout because of inactivity. Try Again');
    window.location.href='login.php';
    </script>");
	}else {
    $_SESSION['logged'] = time();
}

?>
<?php
							//Get IP Address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$ip_address = get_client_ip()

?>
<?php

$sql = "UPDATE tbladmin SET last_login_date=?,last_login_ip=? where username=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$current_date,$ip_address, $username]);

session_destroy(); //destroy the session
?>

<script>
window.location="login.php";
</script>
<?php
//to redirect back to "index.php" after logging out
  exit;
?>
