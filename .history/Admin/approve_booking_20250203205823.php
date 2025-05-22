<?php
include('../inc/config.php');
if (empty($_SESSION['login_username'])) {
    header("Location: login.php");
}

$id= $_GET['id'];
$sql = "DELETE FROM places WHERE id=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

header("Location: tourist-center-record.php");
 ?>
