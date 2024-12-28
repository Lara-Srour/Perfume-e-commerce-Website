<html>
<head> 
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <?php 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'Logout') {  
        session_destroy();  
        header('Location: login.php');  
        die;  
    }  
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'Login') {  
        header('Location: login.php');  
        die;  
    }  
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'Register Now') {  
        header('Location: registration.php');  
        die;  
    }  
    ?>
     
    <header>
       <div class="logo"><h2>Perfumia</h2></div>

        <ul class ="navbar">
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li>
             <div class="dropdown">
               <a class="dropbtn">Perfumes</a>
               <div class="dropdown-content">
                    <a href="perfumes.php?category=women">Women</a>
                    <a href="perfumes.php?category=men">Men</a>
              </div>
             </div>
            </li>
        </ul>

        <div class="h-icons">
        <a href="<?php echo !empty($_SESSION['user_info']) ? 'cart.php' : 'login.php'; ?>">
           <i class='bx bx-shopping-bag'></i>
        </a>
            
            </a>
            <!--<a href="login.php"><i class='bx bx-user'></i></a>-->
            <div id="menu-icon" class="bx bx-menu"></div>
        </div>

    <?php 

    if (!empty($_SESSION['user_info'])):?>  
    <div class="user-box" id="user-box">  
      <form method="post">  
        <p>username: <span><?php echo $_SESSION['user_info']['name']?></span></p>  
        <p>email: <span><?php echo $_SESSION['user_info']['email']?></span></p>  
        <button type="submit" class="logout-btn" name="action" value="Logout">Logout</button>  
      </form>  
    </div>  
    <?php elseif (empty($_SESSION['user_info'])):?>  
    <div class="user-box" id="user-box">  
      <form method="post">  
        <p><span>YOU ARE NOT LOGGED IN</span></p>  
        <button type="submit" class="logout-btn" name="action" value="Login">Login</button>  
        <button type="submit" class="logout-btn" name="action" value="Register Now">Register Now</button>  
      </form>  
    </div>  
  <?php endif; ?> 
    </header>
    <script src="js/menu.js"></script>
</body>

<style>
  p,span{
    
	font-size: 1rem;
	color: black;

  }



</style>