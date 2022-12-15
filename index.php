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
  <title>User - Login and Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<style>
  {
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
    font-size: 16px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
body {
    background-color: #FFFFFF;
    margin: 0;
}
.navtop {
    background-color: #3f69a8;
    height: 60px;
    width: 100%;
    border: 0;
}
.navtop div {
    display: flex;
    margin: 0 auto;
    width: 1000px;
    height: 100%;
}
.navtop div h1, .navtop div a {
    display: inline-flex;
    align-items: center;
}
.navtop div h1 {
    flex: 1;
    font-size: 24px;
    padding: 0;
    margin: 0;
    color: #ecf0f6;
    font-weight: normal;
}
.navtop div a {
    padding: 0 20px;
    text-decoration: none;
    color: #c5d2e5;
    font-weight: bold;
}
.navtop div a i {
    padding: 2px 8px 0 0;
}
.navtop div a:hover {
    color: #ecf0f6;
}




.home .images {
    display: flex;
    flex-flow: wrap;
    margin-left: 40px;
    /* width: 1500px; */
    /* position: center; */

}
.home .images a {
    display: block;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    width: 300px;
    height: 200px;
    margin: 20px 20px 20px 0;
}
.home .images a:hover span {
    opacity: 1;
    transition: opacity 1s;
}






    </style>
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
            <button type='button' onclick=\"popup('login-popup')\">LOGIN</button>
            <button type='button' onclick=\"popup('register-popup')\">REGISTER</button>
            <button type='button' onclick=\"popup('admin-popup')\">Admin</button>
          
            
          </div>
        ";
      }
    
    ?>
  </header>
  
  
  
  <?php 

      $sql="SELECT * FROM `images` WHERE status=True";
      $query=mysqli_query($con,$sql);
      $rows=mysqli_num_rows($query);
      
      
  ?>


  <div class="content home">
	<div class="images">
	<?php	
  while($result=mysqli_fetch_assoc($query)){
      ?>

      
		<a href="#">
    <?php $img=$result['image_name']?>
			<img src="upload/.<?=$img?>"  width="300" height="200">
			
		</a>
		
		<?php } ?>
	</div>
</div>
<div class="image-popup"></div>




  <div class="popup-container" id="login-popup">
    <div class="popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER LOGIN</span>
          <button type="reset" onclick="popup('login-popup')">X</button>
        </h2>
        <input type="text" placeholder="E-mail or Username" name="email_username">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="login-btn" name="login">LOGIN</button>
      </form>
    </div>
  </div>
  
  <!-- Admin login -->
  <div class="popup-container" id="admin-popup">
    <div class="popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>ADMIN LOGIN</span>
          <button type="reset" onclick="popup('admin-popup')">X</button>
        </h2>
        <input type="text" placeholder="E-mail or Username" name="amail">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="login-btn" name="admin_login">LOGIN</button>
      </form>
    </div>
  </div>



  <div class="popup-container" id="register-popup">
    <div class="register popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER REGISTER</span>
          <button type="reset" onclick="popup('register-popup')">X</button>
        </h2>
        <input type="text" placeholder="Full Name" name="fullname">
        <input type="text" placeholder="Username" name="username">
        <input type="email" placeholder="E-mail" name="email">
        <input type="password" placeholder="Password" name="password">
        <input type="text" placeholder="Referral Code" name="referralcode" id="refercode">
        <button type="submit" class="register-btn" name="register">REGISTER</button>
      </form>
    </div>
  </div>


  

  <script>
    function popup(popup_name)
    {
      get_popup=document.getElementById(popup_name);
      if(get_popup.style.display=="flex")
      {
        get_popup.style.display="none";
      }
      else
      {
        get_popup.style.display="flex";
      }
    }
  </script>

<?php 

  if(isset($_GET['refer']) && isset($_GET['refer'])!='')
  {
    if(!(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true))
    {
      $query="SELECT * FROM `registered_users` WHERE `referral_code`='$_GET[refer]'";
      $result=mysqli_query($con,$query);
      if(mysqli_num_rows($result)==1)
      {
        echo"
          <script defer>
            document.getElementById('refercode').value='$_GET[refer]';
            popup('register-popup');
          </script>
        ";
      }
      else
      {
        echo"
          <script>
            alert('Invalid Referral Code');
          </script>
        ";
      }
    }
  }

?>

</body>
</html>