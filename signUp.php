<?php
require "connection.php";

function createUser($first_name,$last_name,$username,$password){
    // Database Connection
    $conn = connection();

    // SQL
    $password=password_hash($password, PASSWORD_DEFAULT);
    $sql="INSERT INTO users
    (
        `first_name`,
        `last_name`,
        `username`,
        `password`
    )
    VALUES
    (
        '$first_name',
        '$last_name',
        '$username',
        '$password'
    )
    ";

    // Execution
    if ($conn->query($sql)){
        header("location: login.php");
        exit;
    }else{
        die ("Error Adding New User! ".$conn->error);
    }
}

if (isset($_POST['btn_sign_up'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];

    if ($password==$confirm_password){
        createUser($first_name,$last_name,$username,$password);
    }else{
        echo "<p class='text-danger'>Password and Confirm Password do not match. </p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sign-Up</title>
</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto">
                <div class="card-header text-success">
                    <h1 class="card-title h3 mb-0">Create Your Account</h1>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="first_name" class="small">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control mb-2" required autofocus>

                        <label for="last_name" class="small">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control mb-2" required>

                        <label for="username" class="small fw-bold">User Name</label>
                        <input type="text" name="username" id="username" class="form-control mb-2 fw-bold" required>
                    
                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>

                        <label for="confirm_password" class="small">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control mb-2" required>
                    
                        <button type="submit" class="form-control btn btn-success btn-block" name="btn_sign_up">Sign up</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="small">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>