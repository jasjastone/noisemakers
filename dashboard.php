<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
}
else {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <title>Dashboard</title>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1>Welcome <?php echo $_SESSION['email']; ?> Back</h1>

            </div>
            <div><a href="./logout.php">Log out</a></div>
        </div>
    </body>

    </html>


<?php

} ?>