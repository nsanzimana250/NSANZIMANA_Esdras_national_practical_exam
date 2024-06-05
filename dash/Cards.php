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
  $cardname=$_POST['cardname'];
  $playe_id=$_POST['playe_id'];
  $Match_id=$_POST['Match_id'];
  $issue_date=$_POST['issue_date'];
  $expiry=$_POST['expiry'];
  $sql=$conn->query("INSERT INTO `Cards`(`cardName`, `Player_id`, `match_id`, `issue_date`, `expiry_date`) 
  VALUES ('$cardname','$playe_id','$Match_id','$issue_date','$expiry')");
  header("location:Cards.php");
}
// delete process
if (isset($_GET['delete'])) {
  $id=$_GET['delete'];
  $sql=$conn->query("DELETE FROM `Cards` WHERE `card_id`='$id'");
  header("location:Cards.php");
}
// update process
$cardname=$playe_id=$Match_id=$issue_date=$expiry="";
if (isset($_GET['update'])) {
  $update=true;
  $active=true;
  $id=$_GET['update'];
  $sql=$conn->query("SELECT * FROM `Cards` WHERE `card_id`='$id'");
  $result=$sql->fetch_array();
  $cardname=$result['cardName'];
  $playe_id=$result['Player_id'];
  $Match_id=$result['match_id'];
  $issue_date=$result['issue_date'];
  $expiry=$result['expiry_date'];
}
if (isset($_POST['edit'])) {
  $id=$_POST['id'];
  $cardname=$_POST['cardname'];
  $playe_id=$_POST['playe_id'];
  $Match_id=$_POST['Match_id'];
  $issue_date=$_POST['issue_date'];
  $expiry=$_POST['expiry'];
  $sql=$conn->query("UPDATE `Cards` SET `cardName`='$cardname',`Player_id`='$playe_id',`match_id`='$Match_id',`issue_date`='$issue_date',`expiry_date`='$expiry' WHERE `card_id`='$id'");
  header("location:Cards.php");
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
      <h1>add card </h1>
      </div>
      <div class="head">
      <p>dashbord / Card</p>
      </div>

      <?php if($active==true): ?>
        <form class="form" action="" method="post">
        <?php if($update==true): ?>
          <p>update process</p>
          <?php else: ?>
            <p>add new</p>
          <?php endif; ?>
          <input type="hidden" name="id" value="<?php echo $id ?>">

          <select name="cardname" id="">
            <option value="red">red</option>
            <option value="yellow">yellow</option>
          </select>
          
          <label for="">select player</label>
          <select name="playe_id" id="">
            <?php
            $sql=$conn->query("SELECT `Player_id`, `PlayerFirstName`, `PlayerLastName` FROM `Player` ");
            while ($row=$sql->fetch_array()) { ?>
              <option value="<?php echo $row['Player_id'] ?>"><?php echo $row['PlayerFirstName']." ".$row['PlayerLastName'] ?></option>
            <?php } ?>
          </select>
          <label for="">select match</label>
          <select name="Match_id" id="">
            <?php
            $sql=$conn->query("SELECT `Match_id`, `Studium_id`, `MatchDate` FROM `Matchs` ");
            while ($row=$sql->fetch_array()) { ?>
              <option value="<?php echo $row['Match_id'] ?>"><?php echo $row['MatchDate']?></option>
            <?php } ?>
          </select>

          
          <input type="date" required name="issue_date" placeholder="issue date"value="<?php echo $issue_date ?>">
          <input type="date" required name="expiry" placeholder="expiry date"value="<?php echo $expiry ?>">
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
           <th>cardName</th>
           <th>Player </th>
           <th>match</th>
           <th>issue_date</th>
           <th>expiry_date</th>
           <th colspan="2" >action</th>
          </tr>
          <?php
          $sql=$conn->query("SELECT * FROM `Cards` INNER JOIN Matchs ,Player WHERE Cards.match_id=Matchs.Match_id AND Cards.Player_id=Player.Player_id");
          $nu=1;
          while ($row=$sql->fetch_array()) { ?>
            <tr>
              <td><?php echo $nu;?></td>
              <td><?php echo $row['1']; ?></td>
              <td><?php echo $row['PlayerFirstName']." ".$row['PlayerLastName']; ?></td>
              <td><?php echo $row['MatchDate']; ?></td>
              <td><?php echo $row['4']; ?></td>
              <td><?php echo $row['5']; ?></td>
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