<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>Employee</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>this is Emoloyee page</p>

      <a href="add_sale.php" class="btn">Sales</a>
      <a href="sale_list.php" class="btn">Sales List</a>
      <a href="inventory.php" class="btn">Inventory</a>
      <a href="inventory_list.php" class="btn">Inventory Info</a>
      <a href="stocks.php" class="btn">Stocks</a>
      <a href="stock_list.php" class="btn">Stocks Info</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>