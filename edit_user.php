
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
<style>
    
      h1 {
      padding: 10px 0;
      font-size: 32px;
      font-weight: 300;
      text-align: center;
      }
      p {
      font-size: 12px;
      }
      hr {
      color: #a9a9a9;
      opacity: 0.3;
      }
      .main-block {
      max-width: 340px; 
      min-height: 460px; 
      padding: 10px 0;
      margin: auto;
      border-radius: 5px; 
      border: solid 1px #ccc;
      box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
      background: #ebebeb; 
      }
      form {
      margin: 0 30px;
      }
      .account-type, .gender {
      margin: 15px 0;
      }
      input[type=radio] {
      display: none;
      }
      label#icon {
      margin: 0;
      border-radius: 5px 0 0 5px;
      }
      label.radio {
      position: relative;
      display: inline-block;
      padding-top: 4px;
      margin-right: 20px;
      text-indent: 30px;
      overflow: visible;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 9px;
      height: 4px;
      top: 8px;
      left: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      input[type=text], input[type=password] {
      width: calc(100% - 57px);
      height: 36px;
      margin: 13px 0 0 -5px;
      padding-left: 10px; 
      border-radius: 0 5px 5px 0;
      border: solid 1px #cbc9c9; 
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #fff; 
      }
      input[type=password] {
      margin-bottom: 15px;
      }
      #icon {
      display: inline-block;
      padding: 9.3px 15px;
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #1c87c9;
      color: #fff;
      text-align: center;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 100%;
      padding: 10px 0;
      margin: 10px auto;
      border-radius: 5px; 
      border: none;
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #26a9e0;
      }
    </style>
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
echo $emailold=$_GET['email'];
$sql="SELECT * FROM registered_users Where email='$emailold' order by referral_point DESC";
$query=mysqli_query($con,$sql);
$rows=mysqli_num_rows($query);
$result=mysqli_fetch_assoc($query);
// echo $result['full_name'];
?>





<div class="main-block">
    <h1>Manage User</h1>
      <form action="" method="POST" enctype="multipart/form-data>
       

      <label id="icon for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="name" id="name" placeholder="Name" required value="<?=$result['full_name']?>"/>
      <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="username" id="username" placeholder="Name" required value="<?=$result['username']?>"/>
      <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="email" id="email" placeholder="Name" required value="<?=$result['email']?>"/>
      <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="refpoint" id="refpoint" placeholder="Name" required value="<?=$result['referral_point']?>"/>

        
                
                    <input type="submit" name="edit_user" value="update" class="btn btn-primary">
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </div> 
        </div>
      </form>
    </div>



<?php
    if(isset($_POST['edit_user']))
{
    echo "im set  ";
    echo $name=mysqli_real_escape_string($con,$_POST['name']);
    echo $username=mysqli_real_escape_string($con,$_POST['username']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $refpoint=mysqli_real_escape_string($con,$_POST['refpoint']);

    echo "   Im empy image N update data";
        $sql3="UPDATE registered_users SET full_name='$name',username='$username',email='$email',referral_point='$refpoint' WHERE email='$emailold'";
                echo $query3=mysqli_query($con,$sql3);
                echo "  Query-ok. ";
                if($query3)
                {
                    
                    
                    echo"
                        <script>
                            alert('updated sucessfully');
                            window.location.href='admin.php';
                        </script>
                        ";
                }
                else
                {
                    echo"
                        <script>
                        alert('Cannot Run Query');
                        window.location.href='admin.php';
                        </script>";
                        
                }

    }
    



?>