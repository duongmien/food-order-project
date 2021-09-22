<?php include('../connect/connectdb.php') ?>
<html>

<head>
  <title>Login-Food Order System</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
  <div class="login">
    <h1 class="text-center">Login</h1>
    <?php
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    ?>
    <br>
    <!-- Login Form -->
    <form action="" method="POST" class="text-center">
      Username: </br>
      <input type="text" name="username" placeholder="Enter Username"> <br><br>
      Password: </br>
      <input type="password" name="pass" placeholder="Enter Password"> <br><br>
      <input type="submit" name="submit" value="Login" class="btn-primary">
    </form>
  </div>
</body>

</html>

<?php
//Check the submit button is click
if (isset($_POST['submit'])) {
  //1.Get data from Form
  $username = $_POST['username'];
  $pass = md5($_POST['pass']);
  // 2. SQL Queery check user with username and password exists or not
  $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$pass'";
  // 3.Excute sql
  $res = mysqli_query($conn, $sql);
  // 4.Check user exist or not use count
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $_SESSION['user']= "Hello, ". $username;
    $_SESSION['login'] = "<div class='text-succes'>Login Succesful!</div>";
    header('location:' . SITEURL . 'admin/');
  } else {
    $_SESSION['login'] = "<div class='text-error  text-center'>Username or Password did not match</div>";
    header('location:' . SITEURL . 'admin/login.php');
  }
}
?>