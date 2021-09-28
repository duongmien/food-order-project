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
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    ?>
    <br> <br>
    <a href="add-category.php" class="btn-primary">Add Category</a>
    <br /><br /><br /><br />
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
      </tr>
      <?php
      $sql = "SELECT * FROM tbl_category";
      $res = mysqli_query($conn, $sql);
      if ($res == TRUE) {
        $count = mysqli_num_rows($res); //Get all the row
        $sn = 1; //Create variable and asign value
        if ($count > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            // Display the value in our Table
      ?>
            <tr>
              <td><?php echo $sn++ . '.' ?></td>
              <td><?php echo $title ?></td>

              <td>
                <?php
                if ($image_name != "") {
                  // Display image
                ?>
                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" width="100px">
                <?php

                } else {
                  echo "<div class='text-error'> Image not Added. </div>";
                }
                ?>
              </td>
              <td><?php echo $featured ?></td>
              <td><?php echo $active ?></td>
              <td>
                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary" href="">Update Category</a>
                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger" href=""> Delete Category</a>
              </td>
            </tr>
      <?php
          }
        } else {
        }
      }
      ?>
    </table>
  </div>
</div>
<?php include('./partials/footer.php') ?>