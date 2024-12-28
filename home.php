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
        <script>
            function scrollToSection(sectionId) {
                const section = document.getElementById(sectionId);
                section.scrollIntoView({ behavior: 'smooth' });
            }
        </script>
      </head>
    <body>
       <?php include("db_config/connect.php");?>

       <?php session_start();
       require "header.php"?>
     
      <section class="home">
        <div class="home-text">
          <h1>Embrace the Aromatic <br> Sentiment</h1>
          <p>Shop and ship your favorite fragrances worldwide.</p>
          <a href="#fragrance-section" class="btn">Shop Now</a>
        </div>
      </section>

     
        </section>

      <?php require "footer.php"?>

      
    </body>
</html>
