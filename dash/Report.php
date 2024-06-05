<?php
session_start();
include "./db.php";
if (empty($_SESSION['User_id'])) {
  header("location:../index.php");
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
      <h1>MAKE REPORT ABOUT SAME THING </h1>
      </div>
      <div class="head">
      <p>dashbord / report</p>
      </div>
        <form class="form" action="view.php" target="_blank" method="post">
          <label for="">select match</label>
          <select name="match" id="">
            <option value="">select match date</option>
            <?php
            $sql=$conn->query("SELECT `Match_id`, `Studium_id`, `MatchDate` FROM `Matchs`");
            while ($row=$sql->fetch_array()) { ?>
            <option value="<?php echo $row['MatchDate']  ?>"><?php echo $row['MatchDate']  ?></option>
          <?php  } ?>
          </select>
            <button type="submit" name="generate">generate</button>
        </form>

  </section>
</body>
</html>