<?php

session_start();
@include 'config.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $user_type = $_POST['user_type'];

    $connection = oci_connect('scott', 'tiger', 'XE');

    $select_sql = "SELECT Name, user_type FROM user_form WHERE Email=:email AND Password=:pass AND user_type=:user_type";
    $select_stmt = oci_parse($connection, $select_sql);
    oci_bind_by_name($select_stmt, ':email', $email);
    oci_bind_by_name($select_stmt, ':pass', $pass);
    oci_bind_by_name($select_stmt, ':user_type', $user_type);
    oci_execute($select_stmt);

    $count = oci_fetch_all($select_stmt, $res);

    if($count == 1){
        $name = $res['NAME'][0];
        if($user_type == 'admin'){
            $_SESSION['admin_name'] = $name;
            header('location:admin_page.php');
        }elseif($user_type == 'user'){
            $_SESSION['user_name'] = $name;
            header('location:user_page.php');
        }
    }else{
        $error = "Invalid email or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="form-container">

   <form action="" method="post">
      <h3>login</h3>
      <?php
      if(isset($error)){
         echo '<span class="error-msg">'.$error.'</span>';
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <select name="user_type">
         <option value="user">Employee</option>
         <option value="admin">Manager</option>
      </select>
      <input type="submit" name="submit" value="login" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>
