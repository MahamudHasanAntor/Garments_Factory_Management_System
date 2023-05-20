<?php
    @include 'config.php';

    if(isset($_POST['submit'])){
        $sale_type = $_POST['sale_type'];
        $sale_num = $_POST['sale_num'];
        $sale_date = $_POST['sale_date'];
        $sale_cus_id = $_POST['sale_cus_id'];
        $sale_desc=$_POST['sale_desc'];
        $sale_amt=$_POST['sale_amt'];
        $emp_id=$_POST['emp_id'];

        $connection = oci_connect('scott', 'tiger', 'XE');

        // Get the current maximum ID from the table
        $max_id_sql = "SELECT MAX(sale_ID) FROM sales";
        $max_id_stmt = oci_parse($connection, $max_id_sql);
        oci_execute($max_id_stmt);
        $max_id = oci_fetch_array($max_id_stmt)[0];

        // Generate a new ID that's one greater than the current maximum
        $new_id = $max_id + 1;

        // Insert the new record into the table
        $insert_sql = "INSERT INTO sales (sale_ID, sale_type, sale_num, sale_date, sale_cus_id, sale_desc, sale_amt, emp_id) VALUES (:sale_id, :sale_type, :sale_num, :sale_date, :sale_cus_id, :sale_desc, :sale_amt, :emp_id)";
        $insert_stmt = oci_parse($connection, $insert_sql);
        oci_bind_by_name($insert_stmt, ':sale_id', $new_id);
        oci_bind_by_name($insert_stmt, ':sale_type', $sale_type);
        oci_bind_by_name($insert_stmt, ':sale_num', $sale_num);
        oci_bind_by_name($insert_stmt, ':sale_date', $sale_date);
        oci_bind_by_name($insert_stmt, ':sale_cus_id', $sale_cus_id);
        oci_bind_by_name($insert_stmt, ':sale_desc', $sale_desc);
        oci_bind_by_name($insert_stmt, ':sale_amt', $sale_amt);
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
      <h1 class="my-5 text-center">Sales Report</h1>
      <div class="row">
         <div class="col-md-6 offset-md-3">
            <form action="add_sale.php" method="post">
            <div class="form-group mb-3">
    <label for="sale_type">Sale Type</label>
    <input type="text" name="sale_type" id="sale_type" class="form-control" required>
</div>
<div class="form-group mb-3">
    <label for="sale_num">Sale Number</label>
    <input type="number" name="sale_num" id="sale_num" class="form-control" required>
</div>
<div class="form-group mb-3">
    <label for="sale_date">Sale Date</label>
    <textarea id="sale_date" class="form-control" rows="1" name="sale_date" required></textarea>
</div>
<div class="form-group mb-3">
    <label for="sale_cus_id">Customer Id</label>
    <input type="number" name="sale_cus_id" id="sale_cus_id" class="form-control" required>
</div>
<div class="form-group mb-3">
    <label for="sale_desc">Sale Description</label>
    <input type="text" name="sale_desc" id="sale_desc" class="form-control" required>
</div>
<div class="form-group mb-3">
    <label for="sale_amt">Sale Ammount</label>
    <input type="number" name="sale_amt" id="sale_amt" class="form-control" required>
</div>
<div class="form-group mb-3">
    <label for="emp_id">Employee ID</label>
    <input type="number" name="emp_id" id="emp_id" class="form-control" required>
</div>
<button type="submit" name="submit" value="Add_sale"  class="btn btn-primary">Add Sales</button>
</div><br>
    </form>
   
<p align="center">Go To Home Page! <a href="user_page.php">Back</a></p>
   </body>
   </html>