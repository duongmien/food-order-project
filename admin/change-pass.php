<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <br>
    <h1>Change Password</h1>
    <br>
    <?php
    if (isset($_SESSION['pass-not-match'])) {
      echo $_SESSION['pass-not-match'];
      unset($_SESSION['pass-not-match']);
    }
    ?>
    <br>
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
    }
    ?>

    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Current Password:</td>
          <td>
            <input type="password" name="current_pass" placeholder="Current Password">
          </td>
        </tr>
        <tr>
          <td>New Password:</td>
          <td>
            <input type="password" name="new_pass" placeholder="New Password">
          </td>
        </tr>
        <tr>
          <td>Confirm Password:</td>
          <td>
            <input type="password" name="confirm_pass" placeholder="Confirm Password">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Change Password">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php
//Check if submit button is click
if (isset($_POST['submit'])) {
  // 1.Get the data from Form
  $id = $_POST['id'];
  $current_pass = md5($_POST['current_pass']);
  $new_pass = md5($_POST['new_pass']);
  $confirm_pass = md5($_POST['confirm_pass']);
  // 2. Check user with current ID and Current Password exist or not
  $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_pass'";
  // Excute sql
  $res = mysqli_query($conn, $sql);
  if ($res == true) {
    // check data is available or not
    $count = mysqli_num_rows($res);
    if ($count == 1) {
      //User Exists and Password can be change
      // echo "User found";
      // Check the new pas and confirm pass match or not
      if ($new_pass == $confirm_pass) {
        // Update Pass
        $sql2 = "UPDATE tbl_admin SET password='$new_pass' WHERE id= $id";
        // Excute the Querry
        $res2 = mysqli_query($conn, $sql2);
        // Check the querry excute
        if ($res2 == true) {
          //Dis succes mes
          $_SESSION['change-pass'] = "<div class='text-succes'>Password Change Succesfully</div>";
          header('location:' . SITEURL . 'admin/manage-admin.php');
        } else {
          $_SESSION['change-pass'] = "<div class='text-error'>Failed to Change Password. Please try again!</div>";
          header('location:' . SITEURL . 'admin/manage-admin.php');
        }
      } else {
        $_SESSION['pass-not-match'] = "<div class='text-error'>New Password and Confirm Password does not match. Please try again!</div>";
        header('location:' . SITEURL . 'admin/change-pass.php');
      }
    } else {
      $_SESSION['user-not-found'] = "<div class='text-error'>User Not Found</div>";
      header('location:' . SITEURL . 'admin/manage-admin.php');
    }
  }
  // 3. Check New Pass and Confirm Pass match or not
  // 4. Change Pass if all abobe is true
}
?>
<?php include('./partials/footer.php') ?>