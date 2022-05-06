<?php

include "connection.php";

function login($username,$password)
{
    // Database Connection
    $conn = connection();

    // SQL
    $sql="SELECT * FROM users WHERE username='$username'";

    // Execution
    $result=$conn->query($sql);

    if ($result->num_rows==1){
        $row=$result->fetch_assoc();

        if (password_verify($password,$row['password'])){
            session_start();

            $_SESSION['user_id']=$row['id'];
            $_SESSION['username']=$row['username'];
            $_SESSION['full_name']=$row['first_name']." ".$row['last_name'];

            header("location:products.php");
            exit();
        }else{
            echo "<p class='text-danger text-center'>Incorrect Password!</p>";
        }
    }else{
        echo "<p class='text-danger text-center'>Username not Found!</p>";
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
    <title>Log-In</title>
</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto">
                <div class="card-header text-primary bg-white">
                    <h1 class="card-title text-center mb-0">Minimart Catalog</h1>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="username" class="small font-weight-bold">User Name</label>
                        <input type="text" name="username" id="username" class="form-control mb-2 font-weight-bold" required>

                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-5" required>

                        <button type="submit" name="btn_log_in" class="form-control btn btn-primary btn-block">Log In</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="signUp.php" class="small">Create Account</a>
                    </div>
                </div>
            </div>
            
            <?php
                if (isset($_POST['btn_log_in'])){
                    $username=$_POST['username'];
                    $password=$_POST['password'];
                
                    login($username,$password);
                }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>