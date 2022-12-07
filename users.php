<?php
include './connection.php';
include './functions.php';
$fetchusers = "SELECT * FROM users";
$exc = mysqli_query($connection, $fetchusers);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>User</title>
</head>

<body>
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>EMail</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($exc) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($exc)) {
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['phone'] ?></td>

                            <td>
                                <a href="./users.php?edit=<?php echo $row['id']; ?>" class="btn text-light btn-warning">Edit</a>
                                <a href="./users.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>

                <?php
                    }
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>


<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM users WHERE id =$id";
    $excdelete = mysqli_query($connection, $delete);
    if ($excdelete) {
        header('Location:./users.php');
    } else {
        echo "User not deleted";
    }
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $selectedit = "SELECT * FROM users WHERE id=$id";
    $excselectedit = mysqli_query($connection, $selectedit);
    if ($excselectedit) {
        $row = mysqli_fetch_array($excselectedit);
?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bg-primary">
                <form action="./users.php" method="post">
                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $row['name'] ?>" id="name" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?php echo $row['email'] ?>" id="email" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Please retype your password" id="password" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm-password" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone-number">Phone Number:</label>
                        <input type="text" name="phone" id="phone-number" value="<?php echo $row['phone'] ?>" class="form-control">
                    </div>
                    <div class="form-group mt-3 d-flex justify-content-center">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
<?php

    }
}
if (isset($_POST['update'])) {

    $name = datasanitaize($connection, $_POST['name']);
    $email = datasanitaize($connection, $_POST['email']);
    $passwd = datasanitaize($connection, $_POST['password']);
    $phone = datasanitaize($connection, $_POST['phone']);
    $update = "UPDATE users SET name='$name',email='$email',password='$passwd',phone='$phone'";
    $result = mysqli_query($connection, $update);
    if ($result) {
        header("Location:./users.php");
    } else {
        echo "Could not update";
    }
}
?>