<?php
    @include 'config.php';

    if(isset($_POST['submit'])){
        $brd_name = $_POST['brd_name'];
        $brd_type = $_POST['brd_type'];
        $brd_desc = $_POST['brd_desc'];
        $emp_id = $_POST['emp_id'];

        $connection = oci_connect('scott', 'tiger', 'XE');

        // Get the current maximum ID from the table
        $max_id_sql = "SELECT MAX(BRD_ID) FROM brands";
        $max_id_stmt = oci_parse($connection, $max_id_sql);
        oci_execute($max_id_stmt);
        $max_id = oci_fetch_array($max_id_stmt)[0];

        // Generate a new ID that's one greater than the current maximum
        $new_id = $max_id + 1;

        // Insert the new record into the table
        $insert_sql = "INSERT INTO brands (BRD_ID, BRD_NAME, BRD_TYPE, BRD_DESC, ID) VALUES (:id, :brd_name, :brd_type, :brd_desc, :emp_id)";
        $insert_stmt = oci_parse($connection, $insert_sql);
        oci_bind_by_name($insert_stmt, ':id', $new_id);
        oci_bind_by_name($insert_stmt, ':brd_name', $brd_name);
        oci_bind_by_name($insert_stmt, ':brd_type', $brd_type);
        oci_bind_by_name($insert_stmt, ':brd_desc', $brd_desc);
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
   <title>Add Brand</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
</head>
<body>
   <div class="container">
      <h1 class="my-5 text-center">Add Brand</h1>
      <div class="row">
         <div class="col-md-6 offset-md-3">
            <form action="" method="post">
               <div class="form-group mb-3">
                  <label for="brd_name">Brand Name</label>
                  <input type="text" name="brd_name" id="brd_name" class="form-control" required>
               </div>
               <div class="form-group mb-3">
                  <label for="brd_type">Brand Type</label>
                  <input type="text" name="brd_type" id="brd_type" class="form-control" required>
               </div>
               <div class="form-group mb-3">
                  <label for="brd_desc">Brand Description</label>
                  <textarea name="brd_desc" id="brd_desc" class="form-control" rows="5" required></textarea>
               </div>
               <div class="form-group mb-3">
                  <label for="emp_id">Employee ID</label>
                  <input type="number" name="emp_id" id="emp_id" class="form-control" required>
               </div>
               <div>
               <div class="form-group mt-4">
   <button type="submit" name="submit" value="Add Brands"  class="btn btn-primary">Add Brands</button>
</div><br>
<p>Go To Home Page! <a href="admin_page.php">Back</a></p>
   </body>
   </html>