<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--bootstrap4 library linked-->
  <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/sneakers-2/100/17-512.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <!--custom style-->
<style type="text/css">
  body {font-family: Arial, Helvetica, sans-serif;}
  form {border: 3px solid #f1f1f1;}

/* Full-width input fields */
input[type=text], input[type=password],input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

button {
  background-color: #000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #363636;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

.container {
  padding: 16px;
  margin-left: 500px;
  margin-right: 100px;

}

span.psw {
  float: right;
  padding-top: 16px;
}
background{
        background-image: linear-gradient(0,#000000,#3C3C3C);
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width:600px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<?php
require 'database/database.php';
  if (isset($_REQUEST['submit'])){
      // removes backslashes
    $username = stripslashes($_REQUEST['username']);
      //escapes special characters in a string
    $username = mysqli_real_escape_string($conn,$username); 
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn,$email);
    $phone = stripslashes($_REQUEST['phone']);
    $phone = mysqli_real_escape_string($conn,$phone);
    $password = stripslashes($_REQUEST['password']);
    $password = md5(mysqli_real_escape_string($conn,$password));
      $query = "INSERT into `users` (UserName,PassWords, Email ,Phone, roleID)
    VALUES ('$username', '$password','$email', '$phone' , 2)";

      $result = mysqli_query($conn,$query);

      if($result){
        header("Location: login.php");
       }
       else{
         echo "Fail";
       }
  }else{
  }
?>
<div class="registration-form">
      <h4 class="text-center"><b><i>Sign Up</i></b></h4>
      <div class="form">
        <form name="register" action="register.php" method="POST" style="border:1px solid #ccc">
          <div class="container">

              <label for="username"><b>Username</b</label>
              <input type="text" class="form-control" name="username" placeholder="Username" required /> </br>
    
              <label for="email"><b>Email</b</label>
              <input type="email" class="form-control" name="email" placeholder="Email" required /> </br>
    
              <label for="phone"><b>Phone</b</label>
              <input type="text" class="form-control" name="phone" placeholder="Phone" require> </br>
        
              <label for="pwd"><b>Password</b</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required /></br>
    
              <label for="pwd"><b>Confirm Password</b</label>
              <input type="password" class="form-control" name="cpassword" placeholder="Enter Confirm password" require> </br>
              <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
              </label>
              <input type="submit" name="submit" value="Sign Up" /></br>
            </div>
        </form>
      </div>
  </div>

</body>
</html> 