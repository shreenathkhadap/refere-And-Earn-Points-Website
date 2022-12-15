
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
  <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Referral Point</th>
                            
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
                                    <td><?= $result['referral_point']?></td>
                                    <td><a href="edit_user.php?id=<?=$result['email']?>" class="btn btn-sm btn-success">Edit</a></td>
                                    
                                    <td>
                                    <form class ="mt-2"  method="POST" onsubmit="return confirm('Are you sure want to delete?')">
                                    <input type="hidden" name="id" value="<?= $result['email'] ?>">
                                    
                                        <input type="submit" name="deletePost" value="Delete" class="btn btn-sm btn-danger">
                                    </form> 
                            </td>     
                                     
                                    
                                   

                            </tr>
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



    <?php 
    if(isset($_POST['deletePost'])){
    $email=$_POST['email'];
    
    $delete="DELETE FROM registered_users WHERE email='$email'";
    $run=mysqli_query($con,$delete);
    if($run){
        
        $msg=['Post has been deleted successfully','alert-success'];
        $_SESSION['msg']=$msg;
        // header("location:admin.php");
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
        // header("location:admin.php");
        echo"
          <script>
            alert('Cannot Run Query');
            window.location.href='admin.php';
          </script>
        ";
        

    }
}



?>

