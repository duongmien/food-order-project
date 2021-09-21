<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <br>
    <h1>Update Admin</h1>
    <br><br>
    <?php
      //Get the ID 
      $id= $_GET['id'];
      //Creat SQL
      $sql="SELECT * FROM tbl_admin   WHERE id=$id";
      //Excute
      $res= mysqli_query($conn, $sql);
      if($res==true){
        $count= mysqli_num_rows( $res);
        if($count==1){
         $row=mysqli_fetch_assoc($res);
         $full_name=$row['fullname'];
         $username= $row['username'];
        }
        else{
          header("location:" . SITEURL . 'admin/manage-admin.php');
        }
      }
    ?>
    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Full Name:</td>
          <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
        </tr>
        <tr>
          <td>Username:</td>
          <td><input type="text" name="username" value="<?php echo $username?>"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include('./partials/footer.php') ?>