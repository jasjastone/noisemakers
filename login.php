<?php
include './connection.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];

    $password = $_POST['password'];

    $select = "SELECT password from users where email='$email'";
    $exclogin= mysqli_query($connection,$select);
    if (mysqli_num_rows($exclogin)> 0) {
        $passwd = mysqli_fetch_array($exclogin);
        if ($password == $passwd['password'] ) {
            session_start();
            $_SESSION['email'] = $email;
            header('Location:./dashboard.php');
        }
        else{
            echo "Wrong email or password passwod";
        }

    }
    else{
        echo "Wrong email or password exc";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container mt-5">
        <form action="./login.php" method="post">
            <div class="form-group mt-5">
                <label for="email">Email:</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="form-group mt-5">
                <label for="password">Password</label>
                <input class="form-control" type="text" name="password" id="password">
            </div>
            <div class="form-group d-flex justify-content-center mt-5">
                <button type="submit" name="login" class="btn text-white btn-info">Login</button>
            </div>
        </form>
    </div>
</body>

</html>