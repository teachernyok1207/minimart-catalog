<?php
session_start();
require "connection.php";

function createSection($title){    
    // Database Connection
    $conn = connection();

    // SQL
    $sql="INSERT INTO sections
    (
        `title`
    )
    VALUES
    (
        '$title'
    )
    ";

    // Execution
    if (($conn->query($sql))){
        header("refresh: 0");
    }else{
        die ("Error Adding New Product Section!".$conn->error);
    }
}

// To Add Section
if (isset($_POST['btn_add'])){
    $title=$_POST['title'];
    createSection($title);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sections</title>
</head>
<body>
    <?php include 'mainMenu.php' ?> 
    <main class="py-5">
        <div class="card w-25 mx-auto mb-5">
            <div class="card-header bg-info text-white">
                <h2 class="card-title h4 mb-0">Add New Section</h2>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <label for="title" class="small">Title</label>
                    <input type="text" name="title" id="title" class="form-control mb-4" required autofocus>
                    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-info px-5" name="btn_add">Add</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>