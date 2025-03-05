<?php
include('../inc/config.php');
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Page Title -->
    <title>Payment Successful | <?php echo $sitename ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo;?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .success-container {
            text-align: center;
            margin-top: 100px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .btn-home {
            margin-top: 20px;
        }
    .style1 {
	font-size: 10px;
	font-weight: bold;
	color: #FF0000;
}
    </style>
</head>
<body>

    <!-- Payment Success Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="success-container">
                    <!-- Success Icon -->
                    <div class="success-icon">✔</div>
                    
                    <!-- Success Message -->
                    <h2>Payment Successful!</h2>
                    <p>Your payment has been Received successfully and Booking has been Approved</p>
                    
					<p class="style1">Constantly check your email for more update.</p>

                    <!-- Additional Details (Optional) -->
                    <p><strong>Transaction ID:</strong> <span id="transaction-id"><?php echo $_SESSION['payment_reference'];  ?></span></p>
                    <p><strong>Amount Paid:</strong> <span id="amount-paid">N<?php echo number_format((float)$_SESSION['payment_amount'] ,2);  ?></span></p>
                    
                    <!-- Button to Return Home -->
                    <a href="index.php" class="btn btn-primary btn-home">Return to Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>