<?php
// include the configuration file
include 'config.php';

// connect to the Oracle database
$connection = oci_connect('scott', 'tiger', 'XE');

// retrieve the stock data from the table
$select_sql = "SELECT * FROM stocks";
$select_stmt = oci_parse($connection, $select_sql);
oci_execute($select_stmt);

$search_value = "";
if(isset($_POST['search'])){
    $search_value = $_POST['search'];
    $select_sql = "SELECT * FROM stocks WHERE STK_DESC LIKE '%$search_value%'";
    $select_stmt = oci_parse($connection, $select_sql);
    oci_execute($select_stmt);
}

// handle delete action
if(isset($_POST['delete'])) {
   $id = $_POST['delete_id'];
   $delete_sql = "DELETE FROM stocks WHERE STK_ID = '$id'";
   $delete_stmt = oci_parse($connection, $delete_sql);
   oci_execute($delete_stmt);
   header("Location: stocks.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Stock List</title>

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
      
      <h2 class="text-center my-4">Stock List</h2>

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
                  <th>Stock ID</th>
                  <th>Type</th>
                  <th>Number</th>
                  <th>Description</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php while($row = oci_fetch_array($select_stmt)) { ?>
                  <tr>
                     <td><?php echo $row['STK_ID']; ?></td>
                     <td><?php echo $row['STK_TYPE']; ?></td>
                     <td><?php echo $row['STK_NUM']; ?></td>
                     <td><?php echo $row['STK_DESC']; ?></td>
                     <td>
                        <a href="edit_stock.php?id=<?php echo $row['STK_ID']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <form method="POST" action="">
                           <input type="hidden" name="delete_id" value="<?php echo $row['STK_ID']; ?>">
                           <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this stock?')">Delete</button>
                        </form>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
            </table>
         <div class="text-center mt-4">
            <a href="user_page.php" class="btn btn-secondary">Back</a>
         </div>


      </div><!-- end of table-container div -->

   </div><!-- end of container div -->

   <!-- Bootstrap JS -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>

