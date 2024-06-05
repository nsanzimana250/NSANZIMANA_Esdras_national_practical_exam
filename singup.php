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
   <!-- php code here -->
   <?php 
   session_start();
   if (!empty( $_SESSION['User_id'])) {
    header("location:./dash/dash.php");
  }
   include "./db.php";
   $fistname=$lastname=$email=$password=$cpassword="";
   $errors=array();
   if (isset($_POST['save'])) {
    $fistname=$_POST['fistname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $sql=$conn->query("SELECT * FROM `User` WHERE `email`='$email'");
    if (empty($fistname)||empty($lastname)||empty($email)||empty($password)||empty($cpassword)) {
      array_push($errors,"there is empty faild");
    }
    if ($sql) {
      $result=$sql->fetch_array();
      if ($result) {
        array_push($errors,"account exist");
      }
    }
    if (strlen($password)<6) {
      array_push($errors,"password must have 6 or more character");
    }
    if ($password!=$cpassword) {
      array_push($errors,"password not mutch");
    }

    if (count($errors)>0) {
      foreach ($errors as $error) {
        echo $error."<br/>";
      }
    }else{
      $sql=$conn->query("INSERT INTO `User`(`firstName`, `lastName`, `email`, `password`) VALUES ('$fistname','$lastname','$email','$password')");
      header("location: index.php");
    }

   }

   ?>
  </div>
  <div class="form">
    <h3>singup form</h3>
    <form action="" method="post">
      <div class="input-content">
        <input type="text" name="fistname" autocomplete="off" placeholder="fistname" id="">
      </div>
      <div class="input-content">
        
        <input type="text" name="lastname" autocomplete="off"  placeholder="lastname" id="">
      </div>
      <div class="input-content">
        
        <input type="email" name="email" autocomplete="off"  placeholder="email" id="">
      </div>
      <div class="input-content">
        
        <input type="password" name="password" autocomplete="off"  placeholder="password" id="">
      </div>
      <div class="input-content">
        
        <input type="password" name="cpassword" autocomplete="off"  placeholder="Re-type-password" id="">
      </div>
      <div class="input-content">
        <button type="submit" name="save" >singup now</button>
      </div>
      <div class="input-content">
        <p>if you have an account <a href="./index.php">Login</a></p>
      </div>
    </form>
  </div>
  <footer>
  copyright &copy;:igitego FC 
    <?php 
    $date=date("Y");
    echo $date;
     ?>

  </footer>
</body>
</html>