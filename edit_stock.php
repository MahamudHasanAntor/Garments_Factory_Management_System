<?php
// include the configuration file
include 'config.php';

// connect to the Oracle database
$connection = oci_connect('scott', 'tiger', 'XE');

// retrieve the stock data from the table
if(isset($_GET['id'])) {
   $id = $_GET['id'];
   $select_sql = "SELECT * FROM stocks WHERE STK_ID = '$id'";
   $select_stmt = oci_parse($connection, $select_sql);
   oci_execute($select_stmt);
   $row = oci_fetch_array($select_stmt);
}

// handle form submission
if(isset($_POST['submit'])) {
   $id = $_POST['id'];
   $type = $_POST['type'];
   $num = $_POST['num'];
   $desc = $_POST['desc'];
   
   $update_sql = "UPDATE stocks SET STK_TYPE = '$type', STK_NUM = '$num', STK_DESC = '$desc' WHERE STK_ID = '$id'";
   $update_stmt = oci_parse($connection, $update_sql);
   oci_execute($update_stmt);
   
   header("Location: stocks.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Stock</title>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <!-- Custom CSS -->
   <style>
      .form-container {
         margin: 50px auto;
         max-width: 800px;
      }
   </style>

</head>
<body>
   
   <div class="container">
      
      <h2 class="text-center my-4">Edit Stock</h2>

      <div class="form-container">

         <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $row['STK_ID']; ?>">
            <div class="form-group">
               <label for="type">Type:</label>
               <input type="text" class="form-control" name="type" value="<?php echo $row['STK_TYPE']; ?>" required>
            </div>
            <div class="form-group">
               <label for="num">Number:</label>
               <input type="text" class="form-control" name="num" value="<?php echo $row['STK_NUM']; ?>" required>
            </div>
            <div class="form-group">
               <label for="desc">Description:</label>
               <input type="text" class="form-control" name="desc" value="<?php echo $row['STK_DESC']; ?>" required>
            </div>
            <div class="form-group">
               <button type="submit" name="submit" class="btn btn-primary">Save</button>
               <a href="stock_list.php" class="btn btn-secondary">Cancel</a>
            </div>
         </form>

      </div><!-- end of form-container div -->

   </div><!-- end of container div -->

   <!-- Bootstrap JS -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html
