<?php
session_start();
require "connection.php";

function getProducts(){    
    // Database Connection
    $conn = connection();

    // SQL
    $sql="SELECT 
    products.id AS `id`,
    products.title AS `title`,
    products.description AS `description`,
    products.price AS `price`,
    sections.title AS `section`
    FROM products 
    INNER JOIN sections
    ON products.section_id=sections.id
    ORDER BY products.id
    ";

    // Execution
    if ($result=$conn->query($sql)){
        return $result;
    }else{
        die ("Error Retrieving Products: ".$conn->error);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Products</title>
</head>
<body>
    <?php include 'mainMenu.php' ?> 
    <main class="container py-5">    
        <a href="sections.php" class="btn btn-outline-info float-right ml-2">
            <i class="fas fa-plus-circle"></i> Add New Section
        </a>
        <a href="addProduct.php" class="btn btn-success float-right">
            <i class="fas fa-plus-circle"></i> Add New Products
        </a>

        <h2 class="h3 text-muted">Product List</h2>

        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>TITLE</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>SECTION</th>
                    <th style="width: 95px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result=getProducts();
                while ($row=$result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= "$". $row['price'] ?></td>
                        <td>
                            <a href="edit-product.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            <a href="remove-product.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>