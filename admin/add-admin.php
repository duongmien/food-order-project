<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <br>
    <h1>Add Admin</h1>
    <br><br>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    ?>
    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Full Name:</td>
          <td><input type="text" name="full_name" placeholder="Enter your name..."></td>
        </tr>
        <tr>
          <td>Username:</td>
          <td><input type="text" name="username" placeholder="Your Username"></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" name="password" placeholder="Your Password"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

  </div>
</div>
<?php include('./partials/footer.php') ?>
<?php
//Procsess the value from Form and Save in Database MySQL
//Check submit button is click or not
if (isset($_POST['submit'])) {
  // 1.Button click get data from Form
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  // 2.SQL Query to save the data into database
  $sql = "INSERT INTO tbl_admin SET
    fullname='$full_name',
    username='$username',
    password='$password'
  ";
  // 3. Excute Query and Save Data in DataBase
  $res = mysqli_query($conn, $sql) or die(mysqli_connect_error());
  // 4. Check data iss insert or not?
  if ($res == true) {
    // Create a session variable message
    $_SESSION['add'] = "<div class='text-succes'> Admin Added Succesfully </div>";
    header("location:" . SITEURL . 'admin/manage-admin.php');
  } else {
    // Create a session variable message
    $_SESSION['add'] = "Failed to Add Admin";
    header("location:" . SITEURL . 'admin/manage-admin.php');
  }
}
?>