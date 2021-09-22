<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Category</h1>
    <br> <br>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    ?>
    <br> <br>
    <a href="add-category.php" class="btn-primary">Add Category</a>
    <br /><br /><br /><br />
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>
    </table>

  </div>
</div>
<?php include('./partials/footer.php') ?>