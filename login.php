<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/sneakers-2/100/17-512.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <link rel="stylesheet" href="./assets/css/base.css">
  <link rel="stylesheet" href="./assets/css/main.css">
  <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.14.0-web/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    form {
      border: 3px solid #f1f1f1;
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
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
      margin-left: 300px;
      margin-right: 300px;

    }

    span.psw {
      float: right;
      padding-top: 16px;
    }

    background {
      background-image: linear-gradient(0, #000000, #3C3C3C);
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

  <?php
  require('database/database.php');
  session_start();
  // If form submitted, insert values into the database.
  if (isset($_POST['username'])) {
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = md5(mysqli_real_escape_string($conn, $password));
    //Checking is user existing in the database or not
    // for Admin
    $query = "SELECT * FROM `users` WHERE UserName='$username'
        and PassWords='$password' and roleID= 1 ";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    //============================================================================
    $username1 = stripslashes($_REQUEST['username']);
    $password1 = stripslashes($_REQUEST['password']);
    $password1 = md5(mysqli_real_escape_string($conn, $password1));
    
    // for Customer
    $query1 = "SELECT * FROM 'users' WHERE UserName='$username1'
        and PassWords='$password1' and roleID= 2 ";
    $result1 = mysqli_query($conn, $query1);
    $rows1 = mysqli_num_rows($result1);
    if ($rows == 1) {
      $_SESSION['login'] = $username;
      // Redirect user to index.php
      header("Location: index.php");
      exit();
    } elseif ($rows1 == 1){
      $_SESSION['login1']=$username;
      header("Location: index.php");
      exit();
    } else {
      echo "<div class='form'>
        <h3>Username/password is incorrect.</h3>
        <br/>Click here to <a href='login.php'>Login</a></div>";
    }
  } else {

  ?>
    <div class="form">
      <h1 align="center"><b><i>Sign in</i></b></h1>
      <form action="login.php" method="post">
        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>

          <button type="submit">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
      <p align="center">Not registered yet? <a href='register.php'>Register Here</a></p>
    <?php } ?>
</body>

</html>