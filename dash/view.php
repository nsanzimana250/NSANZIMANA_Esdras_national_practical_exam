<?php
session_start();
include "./db.php";
if (empty($_SESSION['User_id'])) {
  header("location:../index.php");
}
$match=$_POST['match'];
if (empty($match)) {
  header("location: Report.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>report</title>
  <style>
    body{
      margin: 50px;
      display: flex;
      justify-content: center;
      flex-direction: column;
    }
    table{
      width: 70%;
      border: 1px solid black;
      border-collapse: collapse;
      border-style: dashed;
    }
    table th ,td{
      padding: 10px;
      border: 1px solid black;
      border-collapse: collapse;
      border-style: dashed;
    
    }
    hr{
      border-style: dashed; 
      width: 100%;
    }
  </style>
</head>
<body>
  <h3>::IGITEGO FC::</h3>
  <h3>::Rwanda , Kigali , Gasabo</h3>
  <h3>::Report About Last event match</h3>
  <H4> <u> Date for match is :: <?php echo $match ?>::</u> </H4><br>
  _________________________________________________________________________________________________________________
<br><br>
  <table>
          <tr>
           <th>#</th>
           <th>cardName</th>
           <th>Player </th>
           <th>stadium</th>
           <th>date</th>
          </tr>
          <?php
          $sql=$conn->query("SELECT *
          FROM Player 
          INNER JOIN 
          Cards ON Player.Player_id = Cards.Player_id 
          INNER JOIN Matchs ON Cards.match_id=Matchs.Match_id
          INNER JOIN Studium ON Matchs.Studium_id=Studium.Studium_id
          WHERE Cards.cardName = 'yellow' 
          GROUP BY Player.Player_id 
          HAVING COUNT(Cards.Player_id) <3
          AND Matchs.MatchDate='$match'");
          
          $nu=1;
          while ($row=$sql->fetch_array()) { ?>
            <tr>
              <td><?php echo $nu;?></td>
              <td><?php echo $row['4']; ?></td>
              <td><?php echo $row['PlayerFirstName']." ".$row['PlayerLastName']; ?></td>
              <td><?php echo $row['StudiumName']; ?></td>
              <td><?php echo $match; ?></td>
            </tr>
         <?php $nu++; }  ?>
        </table><br>
  _________________________________________________________________________________________________________________
  <P>this players will  play next match</P>
</body>
</html>