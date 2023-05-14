<?php
    @include 'config.php';

    if(isset($_POST['submit'])){
        $inv_type = $_POST['inv_type'];
        $inv_num = $_POST['inv_num'];
        $inv_desc = $_POST['inv_desc'];
        $emp_id = $_POST['emp_id'];

        $connection = oci_connect('scott', 'tiger', 'XE');

        // Get the current maximum ID from the table
        $max_id_sql = "SELECT MAX(INV_ID) FROM inventory";
        $max_id_stmt = oci_parse($connection, $max_id_sql);
        oci_execute($max_id_stmt);
        $max_id = oci_fetch_array($max_id_stmt)[0];

        // Generate a new ID that's one greater than the current maximum
        $new_id = $max_id + 1;

        // Insert the new record into the table
        $insert_sql = "INSERT INTO inventory (INV_ID, INV_TYPE, INV_NUM, INV_DESC, EMP_ID) VALUES (:id, :inv_type, :inv_num, :inv_desc, :emp_id)";
        $insert_stmt = oci_parse($connection, $insert_sql);
        oci_bind_by_name($insert_stmt, ':id', $new_id);
        oci_bind_by_name($insert_stmt, ':inv_type', $inv_type);
        oci_bind_by_name($insert_stmt, ':inv_num', $inv_num);
        oci_bind_by_name($insert_stmt, ':inv_desc', $inv_desc);
        oci_bind_by_name($insert_stmt, ':emp_id', $emp_id);

        $success = oci_execute($insert_stmt);

        if($success){
            echo "";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Add Inventory</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
</head>
<body>
   <div class="container">
      <h1 class="my-5 text-center">Add Inventory</h1>
      <div class="row">
         <div class="col-md-6 offset-md-3">
            <form action="" method="post">
               <div class="form-group mb-3">
                  <label for="inv_type">Inventory Type</label>
                  <input type="text" name="inv_type" id="inv_type" class="form-control" required>
               </div>
               <div class="form-group mb-3">
                  <label for="inv_num">Inventory Number</label>
                  <input type="number" name="inv_num" id="inv_num" class="form-control" required>
               </div>
               <div class="form-group mb-3">
                  <label for="inv_desc">Inventory Description</label>
                  <textarea name="inv_desc" id="inv_desc" class="form-control" rows="5" required></textarea>
               </div>
               <div class="form-group mb-3">
                  <label for="emp_id">Employee ID</label>
                  <input type="number" name="emp_id" id="emp_id" class="form-control" required>
               </div>
               <div class="form-group mt-4">
                   <button type="submit" name="submit" value="Add Inventory" class="btn btn-primary">Add</button>
                   </div><br>
<p>Go To Home Page! <a href="user_page.php">Back</a></p>
   </body>
   </html>