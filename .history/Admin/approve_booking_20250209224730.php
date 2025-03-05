<?php
include('../inc/config.php');
if (empty($_SESSION['login_username'])) {
    header("Location: login.php");
}

<?php
    include 'db_connection.php';

    $id = $_POST['id'];

    $query = "UPDATE tblbooking SET status = 'Approved' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Booking approved successfully";
    } else {
        echo "Error approving booking";
    }
?>

header("Location: tourist-center-record.php");
 ?>
