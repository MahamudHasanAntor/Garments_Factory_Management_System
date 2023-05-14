<?php
// include the configuration file
include 'config.php';

// connect to the Oracle database
$connection = oci_connect('scott', 'tiger', 'XE');

// retrieve the inventory data for the selected item
$id = $_GET['id'];
$select_sql = "SELECT * FROM inventory WHERE INV_ID = '$id'";
$select_stmt = oci_parse($connection, $select_sql);
oci_execute($select_stmt);
$row = oci_fetch_array($select_stmt);

// handle form submission
if(isset($_POST['submit'])) {
   $id = $_POST['id'];
   $type = $_POST['type'];
   $num = $_POST['num'];
   $desc = $_POST['desc'];
   $emp_id = $_POST['emp_id'];
   $update_sql = "UPDATE inventory SET INV_TYPE = '$type', INV_NUM = '$num', INV_DESC = '$desc', EMP_ID = '$emp_id' WHERE INV_ID = '$id'";
   $update_stmt = oci_parse($connection, $update_sql);
   oci_execute($update_stmt);
   header("Location: inventory_list.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Inventory</title>

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
      
      <h2 class="text-center my-4">Edit Inventory Item</h2>

      <div class="form-container">

         <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $row['INV_ID']; ?>">
            <div class="form-group">
               <label for="type">Type:</label>
               <input type="text" class="form-control" name="type" value="<?php echo $row['INV_TYPE']; ?>">
            </div>
            <div class="form-group">
               <label for="num">Number:</label>
               <input type="text" class="form-control" name="num" value="<?php echo $row['INV_NUM']; ?>">
            </div>
            <div class="form-group">
               <label for="desc">Description:</label>
               <input type="text" class="form-control" name="desc" value="<?php echo $row['INV_DESC']; ?>">
            </div>
            <div class="form-group">
               <label for="emp_id">Employee ID:</label>
               <input type="text" class="form-control" name="emp_id" value="<?php echo $row['EMP_ID']; ?>">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary" name="submit">Submit</button>
               <a href="inventory_list.php" class="btn btn-secondary">Cancel</a>
    </div>
    </form>

</div>

</div>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

