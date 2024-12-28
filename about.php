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
       <?php include("db_config/connect.php");?>
       <?php session_start();
       require "header.php"?>
     
      <section class="about">
        <div class="about-img">
          <img src="images/2.jpg">
        </div>
        <div class="about-text">
          <h1>Welcome to Our Perfume World</h1>
          <p>A treasure trove of captivating scents from renowned brands. Immerse yourself in a world of olfactory delights, where the finest fragrances await your exploration.</p> 
          <p>We curate an exquisite collection of perfumes, sourced from prestigious houses and esteemed designers, ensuring that every bottle represents the epitome of luxury and craftsmanship.</p> 
          <p>Whether you seek the timeless elegance of Chanel, the audacious creativity of Dior, the exotic allure of Tom Ford, or the sophisticated charm of Gucci, our selection offers an extensive range of fragrances to suit every discerning taste.</p>
        </div>
        </section>

        <?php require "footer.php"?>

      
    </body>
</html>