
<?php

@include 'config.php';

if(isset($_POST['add'])){
    
   $emp_name = mysqli_real_escape_string($conn, $_POST['emp_name']);
   $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
   $emp_nid = ($_POST['emp_nid']);
   $address = ($_POST['address']);
   $phone = ($_POST['phone']);
   $h_date = ($_POST['h_date']);
   $salary = ($_POST['salary']);
   $shift = ($_POST['shift']);
   $mgr_id = ($_POST['mgr_id']);
   

   $select = " SELECT * FROM employee WHERE emp_id = '$emp_id' && emp_name= '$emp_name' ";
  

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{
   

      if($bookname != $bookdetail){
         $error[] = ' not matched!';
      }else{
         $insert = "INSERT INTO employee(emp_name, emp_id, emp_nid, address, phone, h_date, salary, shift, mgr_id) VALUES
         ('$emp_name','$emp_id','$emp_nid','$address','$phone','$h_date','$salary','$shift','$mgr_id')";

       
        $query =  mysqli_query($conn, $insert);
        // if($query)
        // {
        //    move_uploaded_file($bookimage_tmp_name,$bookimage_folder);
        //    $message[] ='new product update successfully';
        // }
        // else{
        //    $message[]='could not add product';
        // }
        // var_dump( $query);
        // die();
         header('location:add_employee_test.php');
      }
   }

};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form/style.css">
    <title>Add Book</title>
</head>
<style>
   a:link{
      text-decoration:none;
   }
</style>
<body>

    <div>
        <h2 >ADD Book</h2></br>
       <form action="add_employee_test.php" method="post" name="myForm" onsubmit="return validateForm()">
       <input type="number" name="emp_id" required placeholder="enter employee id"><br> 
       <input type="text" name="emp_name" required placeholder="enter employee name"><br>
      <input type="number" name="emp_nid" required placeholder="enter employee nid"><br>
      <input type="text" name="address" required placeholder="enter employee address"><br>
      <input type="text" name="phone" required placeholder="enter employee phone number"><br>
      <input type="text" name="h_date" required placeholder="enter employee hire date"><br>
      <input type="number" name="salary" required placeholder="enter employee salary"><br>
      <input type="text" name="shift" required placeholder="enter employee shift"><br>
      <input type="number" name="mgr_id" required placeholder="enter manager id"><br>
            
            <input type="submit" value="ADD BOOK" name="add" /><br>
            <a href="admin_page.php" class="btn">Admin Home page</a>
            </br>
            </br>
        </form>
    </div>
    
</body>
</html>