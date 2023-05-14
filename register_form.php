<?php

@include 'config.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    $connection = oci_connect('scott', 'tiger', 'XE');

    // Get the current maximum ID from the table
    $max_id_sql = "SELECT MAX(ID) FROM user_form";
    $max_id_stmt = oci_parse($connection, $max_id_sql);
    oci_execute($max_id_stmt);
    $max_id = oci_fetch_array($max_id_stmt)[0];

    // Generate a new ID that's one greater than the current maximum
    $new_id = $max_id + 1;

    // Insert the new record into the table
    $insert_sql = "INSERT INTO user_form (ID, Name, Email, Password, user_type) VALUES (:id, :name, :email, :pass, :user_type)";
    $insert_stmt = oci_parse($connection, $insert_sql);
    oci_bind_by_name($insert_stmt, ':id', $new_id);
    oci_bind_by_name($insert_stmt, ':name', $name);
    oci_bind_by_name($insert_stmt, ':email', $email);
    oci_bind_by_name($insert_stmt, ':pass', $pass);
    oci_bind_by_name($insert_stmt, ':user_type', $user_type);
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
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">employee</option>
         <option value="admin">manager</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>
