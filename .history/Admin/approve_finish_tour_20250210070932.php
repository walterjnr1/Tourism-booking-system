<?php
include('../inc/config.php');
if (empty($_SESSION['login_username'])) {
    header("Location: login.php");
}

	 // for Block admin
if(isset($_GET['id']))
{
$id=intval($_GET['id']);

mysqli_query($conn,"update tblbooking set status='Finish' where id='$id'");
header("location: booking_record.php");
}

// for unBlock admin
if(isset($_GET['uid']))
{
$uid=intval($_GET['uid']);

mysqli_query($conn,"update tbladmin set status='1' where id='$uid'");
header("location: booking_record.php");

}

?>
