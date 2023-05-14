<?php
// include the configuration file
include 'config.php';

// connect to the Oracle database
$connection = oci_connect('scott', 'tiger', 'XE');

// retrieve the inventory data from the table
$select_sql = "SELECT * FROM inventory";
$select_stmt = oci_parse($connection, $select_sql);
oci_execute($select_stmt);

$search_value = "";
if(isset($_POST['search'])){
    $search_value = $_POST['search'];
    $select_sql = "SELECT * FROM inventory WHERE INV_DESC LIKE '%$search_value%'";
    $select_stmt = oci_parse($connection, $select_sql);
    oci_execute($select_stmt);
}

// handle delete action
if(isset($_POST['delete'])) {
   $id = $_POST['delete_id'];
   $delete_sql = "DELETE FROM inventory WHERE INV_ID = '$id'";
   $delete_stmt = oci_parse($connection, $delete_sql);
   oci_execute($delete_stmt);
   header("Location: inventory_list.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inventory List</title>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <!-- Custom CSS -->
   <style>
      .table-container {
         margin: 50px auto;
         max-width: 800px;
      }
   </style>

</head>
<body>
   
   <div class="container">
      
      <h2 class="text-center my-4">Inventory List</h2>

      <div class="table-container">

         <form method="POST" action="">
            <div class="form-group">
               <input type="text" class="form-control" name="search" value="<?php echo $search_value; ?>" placeholder="Search by Description">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary">Search</button>
            </div>
         </form>

         <table class="table table-bordered">
            <thead class="thead-dark">
               <tr>
                  <th>Inventory ID</th>
                  <th>Type</th>
                  <th>Number</th>
                  <th>Description</th>
                  <th>Employee ID</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php while($row = oci_fetch_array($select_stmt)) { ?>
                  <tr>
                     <td><?php echo $row['INV_ID']; ?></td>
                     <td><?php echo $row['INV_TYPE']; ?></td>
                     <td><?php echo $row['INV_NUM']; ?></td>
                     <td><?php echo $row['INV_DESC']; ?></td>
                     <td><?php echo $row['EMP_ID']; ?></td>
                     <td>
                        <a href="edit_inventory.php?id=<?php echo $row['INV_ID']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <form method="POST" action="">
                           <input type="hidden" name="delete_id" value="<?php echo $row['INV_ID']; ?>">
                           <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this inventory item?')">Delete</button>
                           </tr>
               <?php } ?>
            </tbody>
         </table>
         <div class="text-center mt-4">
            <a href="admin_page.php" class="btn btn-secondary">Back</a>
         </div>


      </div><!-- end of table-container div -->

   </div><!-- end of container div -->

   <!-- Bootstrap JS -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
