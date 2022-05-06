<?php
session_start();
require "connection.php";

// To get selected product on products.php
function getProduct($id){  
    // Database Connection
    $conn = connection();

    // SQL
    $sql="SELECT * FROM products";

    // Execution
    if ($result=$conn->query($sql)){
        return $result->fetch_assoc();
    }else{
        die ("Error Retrieving Products: ".$conn->error);
    }
}

// Value from Get
$id=$_GET['id'];
$row=getProduct($id);

// To Get all Sections
function getSections(){    
    // Database Connection
    $conn = connection();

    // SQL
    $sql="SELECT * FROM sections";

    // Execution
    if ($result=$conn->query($sql)){
        return $result;
    }else{
        die ("Error Retrieving Sections: ".$conn->error);
    }
}

function updateProduct($id,$title,$description,$price,$section_id){
    // Database Connection
    $conn = connection();

    // SQL
    $sql="UPDATE products SET `title`='$title',`description`='$description',`price`='$price',`section_id`=$section_id WHERE id=$id";

    // Execution
    if (($conn->query($sql))){
        header("location: products.php");
        exit();
    }else{
        die ("Error Updating Product!".$conn->error);
    }
}

if (isset($_POST['btn_save'])){
    $id=$_GET['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $section_id=$_POST['section_id'];

    updateProduct($id,$title,$description,$price,$section_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include 'mainMenu.php' ?> 
    <main class="card w-25 mx-auto my-5">
        <div class="card-header bg-success text-white">
            <h2 class="card-title h4 mb-0">Edit Product</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <label for="title" class="small">Title</label>
                <input type="text" name="title" class="form-control mb-2" value="<?= $row['title'] ?>" required autofocus>

                <label for="description" class="small">Description</label>
                <textarea type="text" name="description" class="form-control mb-2" rows="4" required>
                    <?= $row['description'] ?>
                </textarea>
                
                <label for="price" class="small">Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="price" id="price" class="form-control" value="<?= $row['price'] ?>" required>
                </div>

                <label for="section_id" class="small">Section</label>
                <select name="section_id" id="section_id" class="form-control mb-5" required>
                    <option value="" hidden>Select Section</option>
                    <?php
                    $result=getSections();
                    while($row=$result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['title']."</option>";
                    }
                    ?>
                </select>

                <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-info px-5" name="btn_save">Save</button>
            </form>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>