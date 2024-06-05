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
if (isset($_POST['save'])) {
  $stadium_id=$_POST['stadium_id'];
  $matchDate=$_POST['matchDate'];
  $sql=$conn->query("INSERT INTO `Matchs`(`Studium_id`, `MatchDate`) VALUES ('$stadium_id','$matchDate')");
}
// delete process
if (isset($_GET['delete'])) {
  $id=$_GET['delete'];
  $sql=$conn->query("DELETE FROM `Matchs` WHERE `Match_id`='$id'");
  header("location: Match.php");
}
// update process
$matchDate=$stadium_id="";
if (isset($_GET['update'])) {
  $update=true;
  $active=true;
  $id=$_GET['update'];
  $sql=$conn->query("SELECT * FROM `Matchs` WHERE `Match_id`='$id'");
  $result=$sql->fetch_array();
  $matchDate=$result['MatchDate'];
}
if (isset($_POST['edit'])) {
  $id=$_POST['id'];
  $stadium_id=$_POST['stadium_id'];
  $matchDate=$_POST['matchDate'];
  $sql=$conn->query("UPDATE `Matchs` SET `Studium_id`='$stadium_id',`MatchDate`='$matchDate' WHERE `Match_id`='$id'");
  header("location: Match.php");
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
      <h1>add match</h1>
      </div>
      <div class="head">
      <p>dashbord / match</p>
      </div>

      <?php if($active==true): ?>
        <form class="form" action="" method="post">
        <?php if($update==true): ?>
          <p>update process</p>
          <?php else: ?>
            <p>add new</p>
          <?php endif; ?>
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <select name="stadium_id">
            <option value="none">select stadium</option>
            <?php
            $sql=$conn->query("SELECT * FROM Studium ");
            while ($row=$sql->fetch_array()) { ?>
              <option value="<?php echo $row['Studium_id']?>"><?php echo $row['StudiumName']?></option>
           <?php  } ?>
          </select>
          <label for="">matchDate</label>
          <input type="date" required name="matchDate" placeholder="matchDate"value="<?php echo $matchDate ?>">

          <?php if($update==true): ?>
            <button type="submit" name="edit">update</button>
          <?php else: ?>
            <button type="submit" name="save">save</button>
          <?php endif; ?>
          
        </form>
        <?php else:?>
          <div class="table">
          <table>

            <tr>
              <th colspan="7" ><form action="" method="post"><button type="submit" class="btn" name="active">add new</button></form></th>
            </tr>
          <tr>
           <th>#</th>
           <th>Studium Name</th>
           <th> date</th>
           <th colspan="2" >action</th>
          </tr>
          <?php
          $sql=$conn->query("SELECT * FROM `Matchs` INNER JOIN Studium WHERE Matchs.Studium_id=Studium.Studium_id");
          $nu=1;
          while ($row=$sql->fetch_array()) { ?>
            <tr>
              <td><?php echo $nu;?></td>
              <td><?php echo $row['StudiumName']?></td>
              <td><?php echo $row['MatchDate']; ?></td>
              <td><a href="?delete=<?php echo $row['0'] ;?>">delete</a></td>
              <td><a href="?update=<?php echo $row['0'] ;?>">update</a></td>
            </tr>
         <?php $nu++; }  ?>
        </table>
        </div>
          <?php endif;?>
    </div>
  </section>
</body>
</html>