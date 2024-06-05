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
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $sql=$conn->query("INSERT INTO `Player`(`PlayerFirstName`, `PlayerLastName`) VALUES ('$fname','$lname')");
  header("location:Player.php");
}
// delete process
if (isset($_GET['delete'])) {
  $id=$_GET['delete'];
  $sql=$conn->query("DELETE FROM `Player` WHERE `Player_id`='$id'");
  header("location:Player.php");
}
// update process
$fname=$lname="";
$id=0;
if (isset($_GET['update'])) {
  $id=$_GET['update'];
  $update=true;
  $active=true;
  $sql=$conn->query("SELECT * FROM `Player` WHERE `Player_id`='$id'");
  $result=$sql->fetch_array();
  $fname=$result['1'];
  $lname=$result['2'];
}
if (isset($_POST['edit'])) {
  $id=$_POST['id'];
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $sql=$conn->query("UPDATE `Player` SET `PlayerFirstName`='$fname',`PlayerLastName`='$lname' WHERE `Player_id`='$i'");
  header("location:Player.php");
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
      <h1>ADD PLAYES</h1>
      </div>
      <div class="head">
      <p>dashbord / playes</p>
      </div>

      <?php if($active==true): ?>
        <form class="form" action="" method="post">
        <?php if($update==true): ?>
          <p>update process</p>
          <?php else: ?>
            <p>add new</p>
          <?php endif; ?>
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <input type="text" required name="fname" placeholder="Fist Name"value="<?php echo $fname ?>">
          <input type="text" name="lname"  required placeholder="Last Name" id=""value="<?php echo $lname ?>">
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
           <th>fist name</th>
           <th>last name</th>
           <th colspan="2" >action</th>
          </tr>
          <?php
          $sql=$conn->query("SELECT * FROM `Player` ");
          $nu=1;
          while ($row=$sql->fetch_array()) { ?>
            <tr>
              <td><?php echo $nu;?></td>
              <td><?php echo $row['1'] ;?></td>
              <td><?php echo $row['2']; ?></td>
              
              
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