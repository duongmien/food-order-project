<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <br>
    <h1>Change Password</h1>
    <br><br>
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
    }
    ?>
    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Current Password:</td>
          <td><input type="password" name="ma_pass" placeholder="Current Password"></td>
        </tr>
        <tr>
          <td>New Password:</td>
          <td><input type="password" name="new_password" placeholder="New Password"></td>
        </tr>
        <tr>
          <td>Confirm Password:</td>
          <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php
//check submit button clik
if (isset($_POST['submit'])) {
  // Get data from form
  $id = $_POST['id'];
  $current_password = md5($_POST['ma_pass']);
  $new_pass = md5($_POST['new_password']);
  $confirm_pass = md5($_POST['confirm_password']);
}
//SQL
$sql = " SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
//Excute
$res = mysqli_query($conn, $sql);
if ($res == TRUE) {
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    if ($new_pass == $confirm_pass) {
      $sql2 = "UPDATE tbl_admin SET password='$new_pass' WHERE id=$id";
      $res2 = mysqli_query($conn, $sql2);
      if ($res2 == TRUE) {
        $_SESSION['change-pass'] = "Password Changed Successfully";
      } else {
        $_SESSION['pass-not-match'] = "Password Did not Match. Please try again!";
      }
    } else {
      $_SESSION['pass-not-match'] = "Password Did not Match. Please try again!";
    }
  } else {
    $_SESSION['user-not-found'] = "User Not Found";
  }
}
?>
<?php include('./partials/footer.php') ?>