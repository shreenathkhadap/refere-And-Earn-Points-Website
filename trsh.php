// <button type='button' onclick=window.location.href='admin.php';>Admin</button>

<a href="edit_user.php?email=<?=$result['email']?>" class="btn btn-sm btn-success">Accept</a>

echo"
      <script>
        alert('Status 0');
        window.location.href='admin_images.php';
      </script>
    ";








    $update="UPDATE `images` SET `status`= True WHERE image_id='$id'";
    $run=mysqli_query($con,$update);
    
    $update2="UPDATE `registered_users` SET `referral_point`=`referral_point`+20  WHERE email='$email'";
    $run2=mysqli_query($con,$update2);
    
    if($run && $run2){
      
        
        echo"
        
        <script>
          alert(' $email Post has been Saved successfully');
          window.location.href='admin_images.php';
          
        </script>
        
      ";
        

    }
    else
    {
      
        echo"
          <script>
            alert('Cannot Run Query');
            window.location.href='admin_images.php';
          </script>
        ";
        

    }









    <?php
    if(isset($_POST['copylink']))
    {
      $link=$_POST['link'];
    
    function Copy($link) {
    
    $link.select();
    document.execCommand("copy");
}
    }
?>



<?php
      echo"<h3 class='box'>
        Your Referral Link: 
          <a href='http://localhost/ref/?refer=$result_fetch[referral_code]'>
            http://localhost/ref/?refer=$result_fetch[referral_code]
          </a>
          
          
      </h3>";
      ?>