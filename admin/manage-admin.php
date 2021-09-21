<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Admin</h1>
    <br />
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    ?>
    <br /><br /><br />
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br /><br /><br /><br />
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>
      <?php
      $sql = "SELECT * FROM tbl_admin";
      $res = mysqli_query($conn, $sql);
      if ($res == TRUE) {
        $count = mysqli_num_rows($res); //Get all the row
        $sn = 1; //Create variable and asign value
        if ($count > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $full_name = $row['fullname'];
            $username = $row['username'];
            // Display the value in our Table
      ?>
            <tr>
              <td><?php echo $sn++ . '.' ?></td>
              <td><?php echo $full_name ?></td>
              <td><?php echo $username ?></td>
              <td>
                <a href="#" class="btn-secondary" href="">Update Admin</a>
                <a  href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id ;?>" class="btn-danger" href=""> Delete Admin</a>
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