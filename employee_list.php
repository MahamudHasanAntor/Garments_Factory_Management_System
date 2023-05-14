<?php
@include 'config.php';
$connection = oci_connect('scott', 'tiger', 'XE');
// Retrieve the employee data from the table
$select_sql = "SELECT * FROM employee";
$select_stmt = oci_parse($connection, $select_sql);
oci_execute($select_stmt);
$search_value = "";
if(isset($_POST['search'])){
    $search_value = $_POST['search'];
    $select_sql = "SELECT * FROM employee WHERE EMP_NAME LIKE '%$search_value%'";
    $select_stmt = oci_parse($connection, $select_sql);
    oci_execute($select_stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee List</title>

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
      
      <h2 class="text-center my-4">Employee List</h2>

      <div class="table-container">

         <form method="POST" action="">
            <div class="form-group">
               <input type="text" class="form-control" name="search" value="<?php echo $search_value; ?>" placeholder="Search by Name">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary">Search</button>
            </div>
         </form>

         <table class="table table-bordered">
            <thead class="thead-dark">
               <tr>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>NID</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Hire Date</th>
                  <th>Salary</th>
                  <th>Shift</th>
                  <th>Manager ID</th>
               </tr>
            </thead>
            <tbody>
               <?php while($row = oci_fetch_array($select_stmt)) { ?>
                  <tr>
                     <td><?php echo $row['ID']; ?></td>
                     <td><?php echo $row['EMP_NAME']; ?></td>
                     <td><?php echo $row['EMP_NID']; ?></td>
                     <td><?php echo $row['ADDRESS']; ?></td>
                     <td><?php echo $row['PHONE']; ?></td>
                     <td><?php echo $row['H_DATE']; ?></td>
                     <td><?php echo $row['SALARY']; ?></td>
                     <td><?php echo $row['SHIFT']; ?></td>
                     <td><?php echo $row['MGR_ID']; ?></td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>

         <div class="text-center mt-4">
            <a href="admin_page.php" class="btn btn-secondary">Back</a>
         </div>

      </div>

   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
