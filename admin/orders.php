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
        if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'Update') {   
          
          $order_ids = (array) $_POST['order_id'];
          $statuses = $_POST['status'];
          
          //var_dump($order_ids);
          //var_dump($statuses);
          
          foreach ($order_ids as $key => $order_id) {
              $order_status = $statuses[$key];
              $query2 = "UPDATE orders SET order_status='$order_status' WHERE id='$order_id'";
              $result = mysqli_query($con, $query2);
          }
          
          
            
        } 
        
        ?>
        <?php require "admin_header.php"; ?>
        <section class="orders">
            <div class="center-text"> 
                <h2>Orders</h2>
            </div>
            <div class="content-wrapper">

            
            <?php
                
            $query="SELECT * FROM orders";
            $result = mysqli_query($con, $query);
            
            ?>
            
            <form method="post">
                <table>
                    <thead>
                        <tr>
                            <td colspan=2>Customer Name</td>
                            <td>Address</td>
                            <td>Total</td>
                            <td>Payment Method</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) == 0): ?>   
                            <tr>
                                <td colspan="5" style="text-align:center;"> No Orders</td>
                            </tr>   
                        <?php else: ?>
                            <?php while ($order = mysqli_fetch_assoc($result)): ?>
                              <input type="hidden" name="order_id[]" value="<?= $order['id'] ?>">

                                <tr>
                                    <td colspan=2>
                                        <?= $order['name'] ?> 
                                    </td>
                                    <td> 
                                        <?= $order['address'] ?>
                                    </td>
                                    <td class="price">&dollar;<?=$order['amount']?></td>
                                    <td><?= $order['payment_method']?></td>
                                    <td>
                                        <select name="status[]" class="status-container">
                                            <option  value="pending" <?= ($order && $order['order_status'] == 'pending') ? 'selected' : '' ?>>pending</option>
                                            <option  value="delivered" <?= ($order && $order['order_status'] == 'delivered') ? 'selected' : '' ?>>delivered</option>
                                        </select>
                                    </td>
                                </tr>
                         
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>

                </table>
                <input type="submit" name="action" value='Update' class="btn-update">
            </form>
            </div>

        </section>
   
    </body>
</html>
