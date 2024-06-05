<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: LOGIN FORM ::</title>
  <link rel="stylesheet" href="./style/style.css">
</head>
<body>
  <header>
    <h2>Igitego FC.</h2>
  </header>
  <div class="php">
    <?php
    session_start();
    if (!empty( $_SESSION['User_id'])) {
      header("location:./dash/dash.php");
    }
    include "./db.php";
    $email=$password="";

    if (isset($_POST['login'])) {
     $email=$_POST['email'];
     $password=$_POST['password'];
     $sql=$conn->query("SELECT * FROM `User` WHERE `email`='$email'");
     $result=$sql->fetch_array();
     if ($result) {
      if ($password==$result['password']) {
        $_SESSION['User_id']=$result['User_id'];
        $_SESSION['firstName']=$result['firstName'];
        $_SESSION['lastName']=$result['lastName'];
        $_SESSION['email']=$result['email'];
        header("location:./dash/dash.php");
      }else{
        echo"incorrect passowrd";
      }
     }else{
      echo"incorrect email";
     }
    }
     ?>
  </div>
  <div class="form">
    <h3>Login from</h3><br>
    <form action="" method="post">
      <div class="input-content">
        
        <input type="email" name="email" autocomplete="off"  placeholder="email" id="">
      </div>
      <div class="input-content">
        
        <input type="password" name="password" autocomplete="off"  placeholder="Password" id="">
      </div>
      <div class="input-content">
        <button type="submit" name="login">Login now</button>
      </div>
      <div class="input-content">
        <p>if you don't have an account <a href="./singup.php">singup</a></p>
      </div>
    </form>
  </div>
  <footer>
    <p>
    copyright &copy;:igitego FC 
    <?php 
    $date=date("Y");
    echo $date;
     ?>
  </p>

  </footer>
  
</body>
</html>