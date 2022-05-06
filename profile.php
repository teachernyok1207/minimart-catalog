<?php
session_start();

include "connection.php";

function getUser($id)
{
    $conn=connection();
    $sql="SELECT * FROM users WHERE id=$id";

    if ($result=$conn->query($sql)){
        return $result->fetch_assoc();
    }else{
        die ("Error Retrieving User! ".$conn->error);
    }
}

$row=getUser($_SESSION['user_id']);

function updatePhoto($id,$image_name,$img_tmp)
{
    $conn=connection();
    $sql="UPDATE users SET photo='$image_name' WHERE id=$id";

    if ($conn->query($sql)){
        $destination="img/".basename($image_name);
        if (move_uploaded_file($img_tmp,$destination)){
            header("refresh: 0");
        }else{
            die("Error moving the photo.");
        }
    }else{
        die("Error Uploading Photo!".$conn->error);
    }
}

// Uploading Profile Photo
if (isset($_POST['btn_update_photo'])){
    $id=$_SESSION['user_id'];
    $image_name=$_FILES['image']['name'];
    $img_tmp=$_FILES['image']['tmp_name'];

    updatePhoto($id,$image_name,$img_tmp);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body>
    <?php include 'mainMenu.php' ?>    
    <main class="container py-5">
        <div class="card w-25 mx-auto">
            <?php 
                echo "<img src='img/".$row['photo']."' alt='".$_SESSION['full_name']."' class='card-img-top'";
            ?>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="custom-file mb-2 col">
                    <label for="image" class="custom-file-label">Choose Photo</label>
                    <input type="file" name="image" id="image" class="form-control custom-file-input" required>
                </div>
                <button type="submit" class="form-control btn btn-outline-secondary btn-sm btn-block" name="btn_update_photo">Update</button>
            </form>
            <div class="mt-5">
                <p class="lead fw-bold mb-0">
                    <?= $row['username'] ?>
                </p>
                <p class="lead">
                    <?= $row['first_name']. ' ' .$row['last_name'] ?>
                </p>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>