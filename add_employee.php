<?php

@include 'config.php';

if(isset($_POST['submit'])){
    $emp_name = $_POST['emp_name'];
    $emp_nid = $_POST['emp_nid'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $h_date = $_POST['h_date'];
    $salary = $_POST['salary'];
    $shift = $_POST['shift'];
    $mgr_id = $_POST['mgr_id'];

    $connection = oci_connect('scott', 'tiger', 'XE');

    // Get the current maximum ID from the table
    $max_id_sql = "SELECT MAX(ID) FROM employee";
    $max_id_stmt = oci_parse($connection, $max_id_sql);
    oci_execute($max_id_stmt);
    $max_id = oci_fetch_array($max_id_stmt)[0];

    // Generate a new ID that's one greater than the current maximum
    $new_id = $max_id + 1;

    // Insert the new record into the table
    $insert_sql = "INSERT INTO employee (ID, emp_name, emp_nid, address, phone, h_date, salary, shift, mgr_id) VALUES (:id, :emp_name, :emp_nid, :address, :phone, :h_date, :salary, :shift, :mgr_id)";
    $insert_stmt = oci_parse($connection, $insert_sql);
    oci_bind_by_name($insert_stmt, ':id', $new_id);
    oci_bind_by_name($insert_stmt, ':emp_name', $emp_name);
    oci_bind_by_name($insert_stmt, ':emp_nid', $emp_nid);
    oci_bind_by_name($insert_stmt, ':address', $address);
    oci_bind_by_name($insert_stmt, ':phone', $phone);
    oci_bind_by_name($insert_stmt, ':h_date', $h_date);
    oci_bind_by_name($insert_stmt, ':salary', $salary);
    oci_bind_by_name($insert_stmt, ':shift', $shift);
    oci_bind_by_name($insert_stmt, ':mgr_id', $mgr_id);

    $success = oci_execute($insert_stmt);

    if($success){
        echo "Registration Page";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Employee</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>add employee</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="emp_name" required placeholder="enter employee name">
      <input type="number" name="emp_nid" required placeholder="enter employee nid">
      <input type="address" name="address" required placeholder="enter employee address">
      <input type="number" name="phone" required placeholder="enter employee phone number">
      <input type="date" name="h_date" required placeholder="hire date">
      <input type="number" name="salary" required placeholder="enter employee salary">
      <input type="text" name="shift" required placeholder="shift">
      <input type="number" name="mgr_id" required placeholder="manager id">
      <input type="submit" name="submit" value="Add Employee" class="form-btn">
      <p>Go To Home Page! <a href="admin_page.php">Back</a></p>
   </form>

</div>

</body>
</html>
