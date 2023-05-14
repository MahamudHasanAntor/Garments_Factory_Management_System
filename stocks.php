<?php
    @include 'config.php';

    if(isset($_POST['submit'])){
        $stk_type = $_POST['stk_type'];
        $stk_num = $_POST['stk_num'];
        $stk_desc = $_POST['stk_desc'];

        $connection = oci_connect('scott', 'tiger', 'XE');

        // Get the current maximum ID from the table
        $max_id_sql = "SELECT MAX(STK_ID) FROM STOCKS";
        $max_id_stmt = oci_parse($connection, $max_id_sql);
        oci_execute($max_id_stmt);
        $max_id = oci_fetch_array($max_id_stmt)[0];

        // Generate a new ID that's one greater than the current maximum
        $new_id = $max_id + 1;

        // Insert the new record into the table
        $insert_sql = "INSERT INTO STOCKS (STK_ID, STK_TYPE, STK_NUM, STK_DESC) VALUES (:id, :stk_type, :stk_num, :stk_desc)";
        $insert_stmt = oci_parse($connection, $insert_sql);
        oci_bind_by_name($insert_stmt, ':id', $new_id);
        oci_bind_by_name($insert_stmt, ':stk_type', $stk_type);
        oci_bind_by_name($insert_stmt, ':stk_num', $stk_num);
        oci_bind_by_name($insert_stmt, ':stk_desc', $stk_desc);

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
   <title>Add Stock</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
</head>
<body>
   <div class="container">
      <h1 class="my-5 text-center">Add Stock</h1>
      <div class="row">
         <div class="col-md-6 offset-md-3">
            <form action="" method="post">
               <div class="form-group mb-3">
                  <label for="stk_type">Stock Type</label>
                  <input type="text" name="stk_type" id="stk_type" class="form-control" required>
               </div>
               <div class="form-group mb-3">
                  <label for="stk_num">Stock Number</label>
                  <input type="number" name="stk_num" id="stk_num" class="form-control" required>
               </div>
               <div class="form-group mb-3">
                  <label for="stk_desc">Stock Description</label>
                  <textarea name="stk_desc" id="stk_desc" class="form-control" rows="5" required></textarea>
               </div>
               <div>
               <div class="form-group mt-4">
   <button type="submit" name="submit" value="Add Stock"  class="btn btn-primary">Add Stock</button>
</div><br>
<p>Go To Home Page! <a href="user_page.php">Back</a></p>
   </body>
   </html>
