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
        $user_id = $_SESSION['user_id'];
        //$subtotal = $_SESSION['subtotal'];
        
         if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Place Order')
         {   
          $date_added = date('Y-m-d H:i:s'); 
          $subtotal = $_POST['subtotal'];
          $address = $_POST['address'];
          $name = $_POST['name'];
          $payment_method = $_POST['payment_method'];
          $product_ids = $_POST['product_ids']; // Retrieve the product IDs
          $query1 = "INSERT INTO orders (`user_id`, `name`, `amount`, `address`, `payment_method`, `date_added`) VALUES ('$user_id', '$name', '$subtotal', '$address', '$payment_method', '$date_added')";

            $result1 = mysqli_query($con, $query1);
            header("Location: home.php");
              
            // Update the cart table with checked = '1' for the product IDs
            foreach ($product_ids as $product_id) {
               $query2 = "UPDATE cart SET checked = '1' WHERE user_id = '$user_id' AND product_id = '$product_id' ";
               $result2 = mysqli_query($con, $query2);
            } 
          }
    require "header.php";
     
    ?>
   <section class="checkout-page">
      <div class="center-text"> 
            <h2>Checkout</h2>
      </div>
      <?php $subtotal = 0;?>

      <div class="container-wrapper">
       <div class="checkout-container">
         <h3>BILLING DETAILS</h3>
         <form method="post">
           <label for="name">Username:</label>
           <input type="text" name="name" required>

           <label for="email">Email:</label>
           <input type="text" name="email" required>

           <label for="address">Address:</label>
           <input type="text" name="address" required>

           <label for="payment">Payment Method:</label>
           <select name="payment_method">
             <option value="credit_card">Credit Card</option>
             <option value="paypal">PayPal</option>
             <option value="bank_transfer">Bank Transfer</option>
           </select>

           <div class="btn-order">
            <button type="submit" name='action' value="Place Order">Place Order</button>
           </div>
         
       </div>
       <?php
         
         $query="SELECT * FROM cart as c INNER JOIN products as p WHERE checked = '0' AND  c.user_id = '$user_id' AND c.product_id=p.id ";
         $result = mysqli_query($con, $query);
         $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

       ?>
       <div class="summary-container">
         <h3 class="summary-heading">YOUR ORDER</h3>
         <table>
          <thead>
            <tr>
              <td colspan="3">PRODUCT</td>
              <td>SUBTOTAL</td>
            </tr>
           </thead>
           <tbody>
           
            <?php foreach ($products as $product): ?>
              <tr>
                <td colspan=3>
                  <input type="hidden" name="product_ids[]" value="<?php echo $product['product_id']; ?>">
                  <span><?php echo $product["name"].' x'. $product["quantity"];?></span>
               </td>
               <td colspan=1 >
               <?php $product_subtotal = $product['quantity']*$product['price']?>
               <span>&dollar;<?php echo $product_subtotal;?></span>
               </td>
              </tr>
              
              <?php 
                $subtotal+= $product_subtotal; ?>
              <?php endforeach; ?>
              <tr>
                <td colspan=3>
                  <label>TOTAL</label>
               </td>
               <td colspan=1>
               <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
               <span>&dollar;<?php echo $subtotal;?></span>
               </td>
              </tr>
          
            </tbody>

         </table>
       </div>
       </form>
      </div>
   </section>
   <?php require "footer.php"?>
   <script src="js/menu.js"></script>
</body>
</html>

