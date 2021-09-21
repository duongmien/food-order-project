<?php
  //Include constant php file here
  include('../connect/connectdb.php');
  //Get the id Admin 
  $id= $_GET['id'];
  // Creat SQL delete
  $sql="DELETE FROM tbl_admin WHERE id=$id";
  //Excute query
  $res= mysqli_query($conn, $sql);
  //Check if the query success
  if($res==True)
  {
    $_SESSION['delete'] = "<div class='text-succes'> Admin Deleted Succesfully </div>";
    header("location:" . SITEURL . 'admin/manage-admin.php');
  }
  else{
    $_SESSION['delete'] = "Failed to Deleted Admin. Try Again Later!";
    header("location:" . SITEURL . 'admin/manage-admin.php');
  }
?>
</div>