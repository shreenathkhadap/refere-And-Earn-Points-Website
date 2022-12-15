

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
    .button {
            border: none;
            padding: 15px 42px;
            border-radius: 15px;
            color: black;
            text-align: auto;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 10px;
            cursor: pointer;
            
        }
    .form-control {
    /* width: 200px;
    height: 3px;
    outline: 1px solid red;
    position: relative; */
    background-color: #d1d1d1;
}
.form-field {
    display: block;
    width: 100%;
    padding: 8px 16px;
    line-height: 25px;
    font-size: 18px;
    font-weight: 500;
    font-family: inherit;
    border-radius: 6px;
    -webkit-appearance: none;
    color: var(--input-color);
    border: 1px solid var(--input-border);
    background:  #d1d1d1;
   
    
   
}

</style>
<body>
  <header>
    <h2>TechFest</h2>
    <nav>
      <a href="user.php">HOME</a>
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
        echo" Home
          <div class='sign-in-up'>
            
          
          <script>
          window.location.href='admin.php';
          </script>
            
          
            
          </div>
        ";
      }
    
    ?>
  </header>

  
  
  <!-- Admin login -->
  



  


  <?php 
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
    {
      echo"<h1 style='text-align: center; margin-top: 50px;'> WELCOME TO TechFest -  $_SESSION[username]</h1>";
      $query="SELECT * FROM `registered_users` WHERE `username`='$_SESSION[username]'";
      $result=mysqli_query($con,$query);
      $result_fetch=mysqli_fetch_assoc($result);
      $rurl="http://localhost/ref/?refer=$result_fetch[referral_code]";

      echo"<h3 class='box'> 
        Your Referral Code: $result_fetch[referral_code] 
      </h3>";
      echo"<h3 class='box'> 
        Your Referral Points: $result_fetch[referral_point] 
      </h3>";
      ?>
      <h3 class='box'>
      Your Referral Link (Get 10 points):
      <input type="text" class="form-field"   value="http://localhost/ref/?refer=<?=$result_fetch['referral_code']?>" id="myInput">
      <button class="button" onclick="myCopy()">Copy Link</button>  
      </h3>

      
      

    

      
    <?php  
    }
  ?>
  
    <form action="" method="POST" enctype="multipart/form-data">
    <h3 class='box'> 
        Task Upload (Get 20 points):<div class="mb-3">
        <br>
                    <input  type="file" name="image" class="form-control"  required >
                    <div class="mb-3">
                    <input type="submit" name="add_image" value="Add" class="btn btn-primary">
                    </div>
                    </h3>    
                </div>
</form>


    
                
            




    <?php
    if(isset($_POST['add_image']))
    {
    
    echo $filename= $_FILES['image']['name'];
    $tmp_name= $_FILES['image']['tmp_name'];
    $size=$_FILES['image']['size']; 
    $image_ext=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $allow_type=['jpg','png','jpeg'];
    $destination="upload/.$filename";

    
    if(in_array($image_ext,$allow_type)){
        if($size<=3000000){
            move_uploaded_file($tmp_name,$destination);
            $sql2="INSERT INTO `images`(`image_name`, `email`, `status`) VALUES ('$filename','$result_fetch[email]',False)";
            
            $query2=mysqli_query($con,$sql2);
            if($query2)
            {
                
                echo"<script>
            alert('Image has sucessfully added','alert-success');
            window.location.href='user.php';
            </script>
          ";
        
            }
            else
            {
                
                    
            echo"<script>
            alert('Something Went wrong(internal problem)');
            window.location.href='user.php';
            </script>
          ";
            }
        }
        else
        {
            
            echo"<script>
        alert('image size should be less than 5mb');
        window.location.href='user.php';
        </script>
      ";
        }
    }
    else
    {
      echo"<script>
      alert('only jpeg, jpg ,png ','alert-success');
      window.location.href='user.php';
      </script>
    ";
    }
    

    
}
?>






<script>
function myCopy() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");
}
</script>





</body>
</html>