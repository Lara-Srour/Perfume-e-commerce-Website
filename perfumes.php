<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Perfume Website</title>
        <meta name="description" content="A perfume website for women and men">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
         include("db_config/connect.php");

         session_start();
         if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'add-to-cart')
         {   //echo ("success");
            if(!empty($_SESSION['user_info'])){ 
            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];
           
            $query1 = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
            
            $result1 = mysqli_query($con, $query1);
              if ($result1 && mysqli_num_rows($result1))
               {
                $quantity = mysqli_fetch_assoc($result1)['quantity'] + 1;
                $query2 = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
                $result = mysqli_query($con, $query2);
            
              }

              else
               { $quantity = 1;
               //add the product to the cart
               $query3 = "INSERT INTO cart (user_id,product_id,quantity) VALUES ('$user_id', '$product_id', '$quantity') limit 1";
               $result = mysqli_query($con, $query3);
              }}
              else {  
                $category = $_GET['category'];
                header('location:perfumes.php?category='.$category.'&flag=1'); 
            }  
         }
         elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'view-product')
         {   //echo ("success");
            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];
            $_SESSION['product_id'] = $product_id;
            header("Location: product.php");
         } 
           
         require "header.php";
         ?>
        <section class="perfume">
            <div class="center-text"> 
                 <h2>Shop Your Perfume</h2>
            </div>

            <div class="new-content">
         
            <?php 
           
                if(!empty($_GET['category']) && $_GET['category'] == 'women'):
                   $query = "SELECT * FROM products WHERE category = 'women'";
                elseif(!empty($_GET['category']) && $_GET['category'] == 'men'):
                   $query = "SELECT * FROM products WHERE category = 'men'";

                endif;

                $result = mysqli_query($con,$query);
                if(mysqli_num_rows($result)>0):
                    while($row = mysqli_fetch_assoc($result)):

                        $id = $row['id'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $image = $row['image'];

            ?> 
                        
                        <div class="row">
                      <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                        <button type="submit" name="action" value="view-product" style="background: none; border: none; padding: 0; margin: 0;">
                            <img src="<?php echo $image;?>">
                            <h4><?php echo $name;?></h4>
                        </button>
                      
    
                          <h5>$<?php echo $price;?></h>
                          <div class="btn_add">
                            <button type="submit" name="action" value="add-to-cart">Add to cart</button>
                            
                          </div>
                      </form>
                     </div>
                    
              <?php 
                    endwhile;
                endif;
                ?> 
            </div>
      </section>

      <?php require "footer.php"?>
      <script src="js/menu.js"></script>
    </body>
    <script src="js/menu.js"></script>
    
</html> 
