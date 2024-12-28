<html>
<head> 
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'Logout') {  
        session_destroy();  
        header('Location: /perfumeProject/login.php');  
        die;  
    }  ?>
<body>
    <?php 
       // Get the number of items in the shopping cart, which will be displayed in the header.
       // $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
       // add this after the bag logo <span>$num_items_in_cart</span>?>
    <header>
       <div class="logo"><h2>Perfumia</h2></div>

        <ul class ="navbar">
            <li><a href="adminProducts.php">Products</a></li>
            <li><a href="orders.php">Orders</a></li>
            
        </ul>

        <div class="h-icons">
          
           
            
           
        </div>

        <?php 

if (!empty($_SESSION['admin_info'])):?>  
<div class="user-box" id="user-box">  
  <form method="post">  
    <p>Admin Name: <span><?php echo $_SESSION['admin_info']['name']?></span></p>  
    <p>Email: <span><?php echo $_SESSION['admin_info']['email']?></span></p>  
    <button type="submit" class="logout-btn" name="action" value="Logout">Logout</button>  
  </form>  
</div>  

<?php endif;?>

    </header>
   
</body>

<style>
  p,span{
    
	font-size: 1rem;
	color: black;

  }



</style>
