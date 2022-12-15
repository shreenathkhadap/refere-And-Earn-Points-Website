


<?php 
  require('connection.php'); 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h2>TechFest</h2>
    <nav>
      <a href="index.php">HOME</a>
      <a href="#">BLOG</a>
      <a href="#">CONTACT</a>
      <a href="#">ABOUT</a>
      
    </nav>
    <?php 
    
      if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
      {
        echo"
          <div class='user'>
            $_SESSION[username] - <a href='logout.php'>LOGOUT</a>
          </div>
        ";
      }
      else
      {
        echo"
          <div class='sign-in-up'>
           
            
            
            
          </div>
        ";
      }
    
    ?>
  </header>





  <?php 
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
    {

    $query="SELECT * FROM `registered_users` order by referral_point DESC";
    $result=mysqli_query($con,$query);
    // $result_fetch=mysqli_fetch_assoc($result);
    
    
    

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Referral Point</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['referral_point'] . "</td>";
echo "</tr>";
}
echo "</table>";
echo '</table>';
      
      
    }
  ?>









</body>
</html>