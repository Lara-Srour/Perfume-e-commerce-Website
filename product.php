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
         $user_id = $_SESSION['user_id'];
         $product_id = $_SESSION['product_id'];
         if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Add To Cart')
         {   if(!empty($_SESSION['user_info'])){ 
            //user_id = $_SESSION['user_id'];
            $quantity = $_POST['quantity'];
            
             
            $query1 = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
            
            $result1 = mysqli_query($con, $query1);
              if ($result1 && mysqli_num_rows($result1))
               {
                $quantity += mysqli_fetch_assoc($result1)['quantity'];
                $query2 = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
                $result = mysqli_query($con, $query2);
                /*if ($result)
                  {
                   echo '<script>
                    window.onload = function() {
                    alert("Item updated in cart!");
                    </script>';
                }
               else {
                   // Insertion failed
                   echo "Error updating row: " . mysqli_error($con);
               }*/
              }

              else
               { 
               //add the product to the cart
               $query3 = "INSERT INTO cart (user_id,product_id,quantity) VALUES ('$user_id', '$product_id', '$quantity') limit 1";
               $result = mysqli_query($con, $query3);
               
              }}
              else {  
                $category = $_GET['category'];
                header('location:product.php?flag=1'); 
            }  
         }
           
           
    
         require "header.php";
         ?>
        

        <section class="product-page">
          <div class="center-text"> 
                 <h2>Shop Your Perfume</h2>
          </div>

          <div class="product">
            <?php 
                
                if(!empty($_SESSION['product_id'])):
                   
                  $id = $_SESSION['product_id'];
               

                  $query = "SELECT * FROM products WHERE id =$id";

                  $result = mysqli_query($con,$query);
                  if(mysqli_num_rows($result)>0):
                    while($row = mysqli_fetch_assoc($result)):
                        $description = $row['description'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $image = $row['image'];

            ?> 
                        <div class=" left image-container" >
                          <img src="<?php echo $image;?>" width="400" height="400">
                        </div>
                        <div class="right product-details">
                            <h3 class="name"><?php echo $name;?></h3><hr>
                            <div class="description-container">
                             <h3 class="label">Key Notes:</h3>
                             <h4 class="description"><?php echo $description;?></h4>
                            </div>
                            <h3 class="price">$<?php echo $price;?></h3>
                            <form method="post">
                              <div class="quantity-control"> 
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button type="button" class="minus-btn">-</button>
                                <input type="number" class="qty" name="quantity" value="1" min="1" placeholder="Quantity" required>
                                <button type="button" class="plus-btn">+</button>
                              </div>
                              <input class="to-cart" name="action" type="submit" value="Add To Cart">
                            </form>
                        </div>
                     
              <?php 
                    endwhile;
                  endif;
                endif;
                ?> 
        </div>
        </section>
      <?php require "footer.php"?>
      <script src="js/menu.js"></script>
    </body>
    
</html> 
