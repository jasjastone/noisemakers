<?php
include './connection.php';
include './functions.php';

$errors = array();

if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        array_push($errors, 'name is required');
    }
    if (empty($_POST['email'])) {
        array_push($errors, 'email is required');
    }
    if (empty($_POST['password'])) {
        array_push($errors, 'password is required');
    }
    if (empty($_POST['confirm_password'])) {
        array_push($errors, 'Confirm Password is required');
    }
    if (empty($_POST['phone'])) {
        array_push($errors, 'phone is required');
    }
    if ($_POST['password'] != $_POST['confirm_password']) {
        array_push($errors, "Password dont match");
    }
    if (empty($errors)) {
        $name = datasanitaize($connection, $_POST['name']);
        $email = datasanitaize($connection, $_POST['email']);
        $passwd = datasanitaize($connection, $_POST['password']);
        $phone = datasanitaize($connection, $_POST['phone']);

        // create the query for inserting the data into the database and set
        // its values
        $insert = "INSERT INTO users(name,email,password,phone) VALUES ('$name','$email','$passwd','$phone')";
        // excute the $select query and then save the result to the $result variable
        $result = mysqli_query($connection, $insert);
        // check if the query is successfully excuted by use the $result variable
        if ($result) {
            // echo message to the user if the user hasbeen register successfully
            header("Location: ./dashboard.php");
        }
        // else if the query is not successfully exceuted we echo message
        // to the user
        else {
            // echo the message to the user
            echo "Fail to register please try again";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="header h1">
            Noise Makers Registration System
        </div>
        <!-- here we use a foreach to loop though all of the erros
        in the errors array that we create at the top
    -->
        <?php foreach ($errors as $error) {
        ?>
            <div class="alert alert-warning text-uppercase"><?php echo $error; ?></div>

        <?php
            // here we close the foreach brace
        } ?>
        <form action="./registration.php" method="post">
            <div class="form-group mt-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm-password" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="phone-number">Phone Number:</label>
                <input type="text" name="phone" id="phone-number" class="form-control">
            </div>
            <div class="form-group mt-3 d-flex justify-content-center">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>