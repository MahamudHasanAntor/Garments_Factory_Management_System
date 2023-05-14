<?php
// include the configuration file
include 'config.php';

// connect to the Oracle database
$connection = oci_connect('scott', 'tiger', 'XE');

// retrieve the brand data from the table
$id = $_GET['id'];
$select_sql = "SELECT * FROM brands WHERE BRD_ID = '$id'";
$select_stmt = oci_parse($connection, $select_sql);
oci_execute($select_stmt);
$row = oci_fetch_array($select_stmt);

// handle update action
if(isset($_POST['update'])) {
   $id = $_POST['id'];
   $name = $_POST['name'];
   $type = $_POST['type'];
   $desc = $_POST['desc'];
   $emp_id = $_POST['emp_id'];
   $update_sql = "UPDATE brands SET BRD_NAME = '$name', BRD_TYPE = '$type', BRD_DESC = '$desc', ID = '$emp_id' WHERE BRD_ID = '$id'";
   $update_stmt = oci_parse($connection, $update_sql);
   oci_execute($update_stmt);
   header("Location: brand_list.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Brand</title>

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
      
      <h2 class="text-center my-4">Edit Brand</h2>

      <div class="form-container">

         <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $row['BRD_ID']; ?>">
            <div class="form-group">
               <label for="name">Name:</label>
               <input type="text" class="form-control" name="name" value="<?php echo $row['BRD_NAME']; ?>" required>
            </div>
            <div class="form-group">
               <label for="type">Type:</label>
               <input type="text" class="form-control" name="type" value="<?php echo $row['BRD_TYPE']; ?>" required>
            </div>
            <div class="form-group">
               <label for="desc">Description:</label>
               <textarea class="form-control" name="desc" rows="5"><?php echo $row['BRD_DESC']; ?></textarea>
            </div>
            <div class="form-group">
               <label for="emp_id">Employee Id:</label>
               <input type="text" class="form-control" name="emp_id" value="<?php echo $row['ID']; ?>" required>
            </div>
            <div class="form-group">
               <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
         </form>

      </div>

   </div>

   <!-- Bootstrap JS -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
