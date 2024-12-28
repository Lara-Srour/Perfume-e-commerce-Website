<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Perfume Website</title>
        <meta name="description" content="A perfume website for women and men">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/perfumeProject/css/admin.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
    <body>

    <?php
        include("C:/xampp/htdocs/perfumeProject/db_config/connect.php");
        session_start();
        $admin_id = $_SESSION['admin_id'];
        $product_id = isset($_GET['product_id'])? $_GET['product_id'] : 'null';

        if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Update/Add Product') {
            // Fetch product details from database if product_id is provided
        $query = "SELECT * FROM products WHERE id = '$product_id'";
        $result = mysqli_query($con, $query);
        $product = mysqli_fetch_assoc($result);

// Get the existing image from the product if it exists
$existingImage = $product ? $product['image'] : '';

if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Update/Add Product') {
    // Existing image name or the new image name
    $image_tmp_name = $_FILES['image']['tmp_name'];
    if (!empty($image_tmp_name)) {
        $image_name = $_FILES['image']['name'];
        $image_folder = 'perfumeProject/images/' . $image_name;

        // Create the directory if it doesn't exist
        if (!is_dir('perfumeProject/images')) {
            mkdir('perfumeProject/images', 0755, true);
        }

        // Move the uploaded file to the destination directory
        move_uploaded_file($image_tmp_name, $image_folder);

        // Set the image name with the directory path
        $image = 'images/' . $image_name;
    } else {
        $image = $existingImage;
    }

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    if ($product) {
        // Update the existing product
        $query2 = "UPDATE products SET name='$name', description='$description', price='$price', image='$image', category='$category' WHERE id='$product_id'";
        $result = mysqli_query($con, $query2);
    } else {
        // Add a new product to the database
        $query3 = "INSERT INTO products (name, description, price, image, category) VALUES ('$name', '$description', '$price', '$image', '$category')";
        $result = mysqli_query($con, $query3);
    }
}

         }
           
        

        // Fetch product details from database if product_id is provided
       
        
            $query = "SELECT * FROM products WHERE id = '$product_id'";
            $result = mysqli_query($con, $query);
            $product = mysqli_fetch_assoc($result);
        
    ?>
    <?php require "admin_header.php"; ?>
    <section class="productInfo-page">
        <div class="center-text"> 
            <h2>Product Details</h2>
        </div>

        <div class="container-wrapper">
            <div class="product-container">
                
                <form method="post" enctype="multipart/form-data">
                    
                <label for="image">Image</label>
                <?php
                $existingImage = $product ? $product['image'] : '';
                ?><br>
                <div style="display: flex; justify-content: center; align-items: center;">
                    <img src="<?='/perfumeProject/'.$existingImage?>" width="100">
                </div>

                <input type="file" name="image" >
                <br><br>
                <input type="hidden" for="imageName"><?= $existingImage ?> <!-- Add this line -->                
                
                    
                    <label for="name">ProductName</label>
                    <input type="text" name="name" value="<?= $product ? $product['name'] : '' ?>" required>

                    <label for="description">Description</label>
                    <input type="text" name="description" value="<?= $product ? $product['description'] : '' ?>" required>

                    <label for="price">Price</label>
                    <input type="text" name="price" value="<?= $product ? $product['price'] : '' ?>" required>

                    <label for="category">Category</label>
                    
                    <select name="category">
                     <option value="Women" <?= ($product && $product['category'] == 'women') ? 'selected' : '' ?>>Women</option>
                     <option value="Men" <?= ($product && $product['category'] == 'men') ? 'selected' : '' ?>>Men</option>
                    </select>

                    <div class="btn-update">
                        <input type="submit" name="action" value="Update/Add Product">
                    </div>
                </form>
            </div>
        </div>
    </section>

    </body>
</html>
