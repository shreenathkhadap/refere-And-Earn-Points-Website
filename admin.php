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
.button {
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
}
tr
{
    text-align: center; 
    vertical-align: middle;
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

  <button class="button button2"><a href="admin_images.php">Manage Images</a></button>

<!-- Begin Page Content -->
<div class="container-fluid ">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                    <thead>
                        <tr >
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Points</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql="SELECT * FROM registered_users order by referral_point DESC";
                        $query=mysqli_query($con,$sql);
                        $rows=mysqli_num_rows($query);
                        $count=0;
                        if($rows){
                            while($result=mysqli_fetch_assoc($query)){
                                ?>
                                <tr>
                                    <td><?= ++$count ?></td>
                                    <td><?= $result['full_name'] ?></td>
                                    <td><?= $result['username'] ?></td>
                                    <td><?= $result['email'] ?></td>
                                    <td><?=$result['referral_point']?></td>
                                    <td><a href="edit_user.php?email=<?=$result['email']?>" class="btn btn-sm btn-success">Edit</a></td>
                                    
                                    
                                    <td>
                                    <form class ="mt-2"  method="POST" onsubmit="return confirm('Are you sure want to delete?')">
                                    <input type="hidden" name="id" value="<?=$result['email'] ?>">
                                    <input type="submit" name="deletePost" value="Delete" class="btn btn-sm btn-danger">
                                    </form> 
                            </td>     
                                
                                    
                                

                                </tr>
                            <?php    
                            }

                        }
                        else
                        {
                            ?>
                            <tr><td colspan="7">No record Found </td></tr>
                            <?php
                        }
                        
                        
                        
                        
                        
                        
                        
                        ?>
                        

                                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>


<?php 
if(isset($_POST['deletePost'])){
    $id=$_POST['id'];
    
    $delete="DELETE FROM registered_users WHERE email='$id'";
    $run=mysqli_query($con,$delete);
    if($run){
       
        $msg=['Post has been deleted successfully','alert-success'];
        $_SESSION['msg']=$msg;
        echo"
        <script>
          alert('Delete Sucesfull');
          window.location.href='admin.php';
        </script>
      ";
        

    }
    else
    {
        $msg=['Failed, please try again','alert-danger'];
        $_SESSION['msg']=$msg;
        echo"
          <script>
            alert('Cannot Run Query');
            window.location.href='admin.php';
          </script>
        ";
        

    }
}



?>
