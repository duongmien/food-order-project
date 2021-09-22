<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Dashboard</h1>
    <br>
    <?php
    if (isset($_SESSION['user'])) {
      echo $_SESSION['user'];
      unset($_SESSION['user']);
    }
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    ?>
    <br>
    <div class="col-4 text-center">
      <h2>5</h2>
      <br />
      Category
    </div>
    <div class="col-4 text-center">
      <h2>5</h2>
      <br />
      Category
    </div>
    <div class="col-4 text-center">
      <h2>5</h2>
      <br />
      Category
    </div>
    <div class="col-4 text-center">
      <h2>5</h2>
      <br />
      Category
    </div>
    <div class="col-4 text-center">
      <h2>5</h2>
      <br />
      Category
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<?php include('./partials/footer.php') ?>