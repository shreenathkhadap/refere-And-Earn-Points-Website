<?php 

require('connection.php');
session_start();

function updateReferral()
{
  $query="SELECT * FROM `registered_users` WHERE `referral_code`='$_POST[referralcode]'";
  $result=mysqli_query($GLOBALS['con'],$query);
  if($result)
  {
    if(mysqli_num_rows($result)==1)
    {
      $result_fetch=mysqli_fetch_assoc($result);
      $point=$result_fetch['referral_point']+10;
      $update_query="UPDATE `registered_users` SET `referral_point`='$point' WHERE `email`='$result_fetch[email]'";
      if(!mysqli_query($GLOBALS['con'],$update_query))
      {
        echo"
          <script>
            alert('Cannot run query');
            window.location.href='index.php';
          </script>
        ";
        exit;
      }
    }
    else
    {
      echo"
        <script>
          alert('Invalid Referral Code');
          window.location.href='index.php';
        </script>
      ";
      exit;
    }
  }
  else
  {
    echo"
      <script>
        alert('Cannot Run Query');
        window.location.href='index.php';
      </script>
    ";
    exit;
  }  
}

#for login
if(isset($_POST['login']))
{
  $query="SELECT * FROM `registered_users` WHERE `email`='$_POST[email_username]' OR `username`='$_POST[email_username]'";
  $result=mysqli_query($con,$query);
  
  if($result)
  {
    if(mysqli_num_rows($result)==1)
    {
      $result_fetch=mysqli_fetch_assoc($result);
      if(password_verify($_POST['password'],$result_fetch['password']))
      {
        $_SESSION['logged_in']=true;
        $_SESSION['username']=$result_fetch['username'];
        header("location: user.php");
      }
      else
      {
        echo"
          <script>
            alert('Incorrect Password');
            window.location.href='index.php';
          </script>
        ";
      }
    }
    else
    {
      echo"
        <script>
          alert('Email or Username Not Registered');
          window.location.href='index.php';
        </script>
      ";
    }
  }
  else
  {
    echo"
      <script>
        alert('Cannot Run Query');
        window.location.href='index.php';
      </script>
    ";
  }
}

#admin Login

if(isset($_POST['admin_login']))
{
  $query="SELECT * FROM `registered_admin` WHERE `email`='$_POST[amail]' OR `username`='$_POST[amail]'";
  $result=mysqli_query($con,$query);
  
  if($result)
  {
    if(mysqli_num_rows($result)==1)
    {
      $result_fetch=mysqli_fetch_assoc($result);
      if($_POST['password']==$result_fetch['password'])
      
      {
        $_SESSION['logged_in']=true;
        $_SESSION['username']=$result_fetch['username'];
        header("location: admin.php");
      }
      else
      {
        echo"
          <script>
            alert('Incorrect Password');
            window.location.href='index.php';
          </script>
        ";
      }
    }
    else
    {
      echo"
        <script>
          alert('Email or Username Not Registered');
          window.location.href='index.php';
        </script>
      ";
    }
  }
  else
  {
    echo"
      <script>
        alert('Cannot Run Query');
        window.location.href='index.php';
      </script>
    ";
  }
}


#for registration
if(isset($_POST['register']))
{
  $user_exist_query="SELECT * FROM `registered_users` WHERE `username`='$_POST[username]' OR `email`='$_POST[email]'";
  $result=mysqli_query($con,$user_exist_query);

  if($result)
  {
    if(mysqli_num_rows($result)>0) #it will be executed if username or email is already taken
    {
      $result_fetch=mysqli_fetch_assoc($result);
      if($result_fetch['username']==$_POST['username'])
      {
        #error for username already registered
        echo"
          <script>
            alert('$result_fetch[username] - Username already taken');
            window.location.href='index.php';
          </script>
        ";
      }
      else
      {
        #error for email already registered
        echo"
          <script>
            alert('$result_fetch[email] - E-mail already registered');
            window.location.href='index.php';
          </script>
        ";
      }
    }
    else #it will be executed if no one has taken username or email before
    {
      if($_POST['referralcode']!='')
      {
        updateReferral();
      }

      $referral_code=strtoupper(bin2hex(random_bytes(4)));

      $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
      $query="INSERT INTO `registered_users`(`full_name`, `username`, `email`, `password`,`referral_code`,`referral_point`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password','$referral_code',0)";
      if(mysqli_query($con,$query))
      {
        #if data inserted successfully
        echo"
          <script>
            alert('Registration Successful');
            window.location.href='index.php';
          </script>
        ";
      }
      else
      {
        #if data cannot be inserted
        echo"
          <script>
            alert('Cannot Run Query');
            window.location.href='index.php';
          </script>
        ";        
      }
    }
  }
  else
  {
    echo"
      <script>
        alert('Cannot Run Query');
        window.location.href='index.php';
      </script>
    ";
  }
}

?>