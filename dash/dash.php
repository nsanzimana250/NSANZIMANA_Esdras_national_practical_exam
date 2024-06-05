<?php
session_start();
include "./db.php";
if (empty($_SESSION['User_id'])) {
  header("location:../index.php");
}

$active=false;
$update=false;
if (isset($_POST['active'])) {
  $active=true;
}

if (isset($_GET['update'])) {
  $update=true;
  $active=true;
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>::dashboard::</title>
</head>
<body>
  <header>
  <h2>Igitego FC.</h2>
    <div class="user">
      <p>USER:: <address><b><?php echo $_SESSION['lastName']." ".$_SESSION['firstName'] ; ?></b></address></p>
    </div>
    <div class="logout">
      <a href="./logout.php">Logout</a>
    </div>
  </header>
  <section>
    <div class="nav">
      <div class="log">
          <h4>IFC</h4>
      </div>
      <ul>
      <a href="dash.php"> <li>Dashboard</li> </a>
        <a href="Player.php"> <li> Add Player</li> </a>
        <a href="Contract.php"> <li>Contract</li> </a>
        <a href="Stadium.php"> <li>Stadium</li> </a>
        <a href="Match.php"> <li> Match</li> </a>
        <a href="Cards.php"> <li>Cards</li> </a>
        <a href="Report.php"> <li>report</li> </a>
        
      </ul>
      <footer>
      <p>
    copyright &copy;:igitego FC
    <?php 
    $date=date("Y");
    echo $date;
     ?>
  </p>
          </footer>
    </div>
    <div class="right">
      <div class="head">
      <h1>WELCOME IN THE SYSTEM</h1>
      </div>
      <div class="head">
      <p>home /</p>
      </div>

      <div class="cord-container">
        <div class="cord">
          <h2>
            <?php
            $sql=$conn->query("SELECT * FROM `Player`");
            $result=mysqli_num_rows($sql);
            echo $result;
             ?>
          </h2>
          <h3>Player</h3>
        </div>
        <div class="cord">
          <h2>
          <?php
            $sql=$conn->query("SELECT * FROM `Contract`");
            $result=mysqli_num_rows($sql);
            echo $result;
             ?>
          </h2>
          <h3>Contact</h3>
        </div>
        <div class="cord">
          <h2>
          <?php
            $sql=$conn->query("SELECT * FROM `Studium`");
            $result=mysqli_num_rows($sql);
            echo $result;
             ?>
          </h2>
          <h3>Stadiun</h3>
        </div>
        <div class="cord">
          <h2>
          <?php
            $sql=$conn->query("SELECT * FROM `Cards`");
            $result=mysqli_num_rows($sql);
            echo $result;
             ?>
          </h2>
          <h3>Cards</h3>
        </div>
      </div>

    </div>

  </section>
</body>
</html>