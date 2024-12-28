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
        $subtotal = 0;
         include("db_config/connect.php");
         session_start();
         $user_id = $_SESSION['user_id'];
         if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'view-product')
         {   
            
            $product_id = $_POST['product_id'];
            $_SESSION['product_id'] = $product_id;
            header("Location: product.php");
         } elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Update')
         {  
          if(!empty($_SESSION['user_info'])){ 
          
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'][$product_id];
            

            foreach ($_POST['quantity'] as $product_id => $quantity) {
              // Update the cart with the new quantity for the product
              if ($quantity == 0):
                {$query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
                $result = mysqli_query($con, $query);
              }elseif($quantity>0):{
                   $query = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
                   $result = mysqli_query($con, $query);
              }
            endif;  
            }}
            else {  
              
              header('location:cart.php?&flag=1'); 
          }  
          
        }

         elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Place Order')
         {   //echo ("success");
           
          if(!empty($_SESSION['user_info'])){ 
            $subtotal = $_POST['subtotal'];
           // $_SESSION['subtotal'] = $subtotal;
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'][$product_id];
            
            

            foreach ($_POST['quantity'] as $product_id => $quantity) {
              // Update the cart with the new quantity for the product
              if ($quantity == 0):
                {$query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
                $result = mysqli_query($con, $query);
              }elseif($quantity>0):{
                   $query = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id' AND checked='0'";
                   $result = mysqli_query($con, $query);
              }
            endif;  
            } 
             header("Location: checkout.php"); 
         } 
         else {  
          header('location:login.php'); 
      }  
    }
         


         require "header.php";
         
         ?>
        <section class="cart">
            <div class="center-text"> 
                 <h2>Cart</h2>
            </div>
            <div class="content-wrapper">

            
             <?php
                
                $query="SELECT * FROM cart as c INNER JOIN products as p WHERE c.user_id = '$user_id' AND c.product_id=p.id AND checked='0'";
                $result = mysqli_query($con, $query);
                $products = mysqli_fetch_all($result, MYSQLI_ASSOC);


             ?>
            
             <form method="post">
                <table>
                  <thead>
                    <tr>
                      <td colspan="2">Product</td>
                      <td>Price</td>
                      <td>Quantity</td>
                      <td>Total</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($products)): ?>
                      <tr>
                        <td colspan="5" style="text-align:center; color:black;">You have no products added in your Shopping Cart</td>
                      </tr>
                      
                    <?php else: ?>
                      <?php foreach ($products as $product): ?>
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                         <tr>
                            <td class="img">
                               <button type="submit" name="action" value="view-product" style="background: none; border: none; padding: 0; margin: 0;">
                                    <img src="<?=$product['image']?>" width="50" height="50" alt="<?=$product['name']?>">
                               </button>
                            </td>
                            <td>
                              <button type="submit" name="action" value="view-product" style="background: none; border: none; padding: 0; margin: 0;">
                                <?=$product['name']?></button>
                            </td>
                            <td class="price">&dollar;<?=$product['price']?></td>
                            <td class="quantity-control">
                                <button type="button" class="minus-btn">-</button>
                                <input type="number" class="qty" name="quantity[<?=$product['product_id']?>]" value="<?=$product['quantity']?>" min="0" placeholder="Quantity" required>
                                <button type="button" class="plus-btn">+</button>
                               
                            </td>
                            <td class="price">&dollar;<?=$product['price'] * $product['quantity']?></td>
                         </tr>
                         <?php $subtotal += $product['price'] * $product['quantity'];?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                 </tbody>
                </table>
                <div class="subtotal">
                 <span class="text" name="subtotal">Subtotal</span>
                 <span class="price">&dollar;<?=$subtotal?></span>
                </div>
                <div class="buttons">
                 <input type="submit" value="Update" name="action">
                 <input type="submit" value="Place Order" name="action" <?php echo empty($products) ? 'disabled' : ''; ?>>
                </div>
             </form>
            </div>

        </section>
      <?php require "footer.php"?>
      <script src="js/menu.js"></script>
    </body>
</html> 
