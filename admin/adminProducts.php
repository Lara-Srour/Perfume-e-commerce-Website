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
         if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Delete')
         {   
            $product_id = $_POST['product_id'];
            $query = "DELETE FROM products WHERE id = '$product_id'";
            $result = mysqli_query($con, $query);

         } 
         elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Modify')
         {   
            $product_id = $_POST['product_id'];
            $_SESSION['product_id'] = $product_id;
            header("Location: product_info.php");
         } 

         ?>
         <?php require "admin_header.php"; ?>
        <section class="products-container">
            <div class="center-text"> 
                 <h2>Admin Pannel</h2>
            </div>
            <div class="content-wrapper">

            
             <?php
                
                $query="SELECT * FROM products";
                $result = mysqli_query($con, $query);
                $products = mysqli_fetch_all($result, MYSQLI_ASSOC);


             ?>
            
             <form method="post">
                <table>
                  <thead>
                    <tr>
                      <td colspan="2">Product</td>
                      <td>Price</td>
                      <td></td>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($products)): ?>
                      <tr>
                        <td colspan="5" style="text-align:center;">You have no products added</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($products as $product): ?>
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                         <tr>
                            <td class="img">
                             <span><img src="/perfumeProject/<?=$product['image']?>" width="60" height="60" alt="<?=$product['name']?>"></span>
                            </td>
                            <td>
                             <span><?= $product['name'] ?></span><br>
                             <span><?= $product['description'] ?></span>
                            </td>
                            <td class="price">&dollar;<?=$product['price']?></td>
                            <td class="buttons">
                             <a href="product_info.php?product_id=<?=$product['id']?>" class="links">Modify</a>
                             <input type="submit" name="action" value="Delete">
                            </td> 
                         </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                 </tbody>
                </table>
                
                <div class="buttons">
                 <a href="product_info.php" class="links" >Add New Product</a>
                
                </div>
             </form>
            </div>

        </section>
   
    </body>
</html> 
