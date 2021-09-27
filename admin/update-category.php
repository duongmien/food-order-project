<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>
    <br><br><br>
    <!-- Seclect data from Home Category -->
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_category WHERE id= $id";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $featured = $row['featured'];
        $active = $row['active'];
        $current_image = $row['image_name'];
      } else {
        header("location:" . SITEURL . 'admin/manage-category.php');
      }
    }
    ?>
    <!-- Add category Form -->
    <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>New Title:</td>
          <td>
            <input type="text" name="title" value="<?php echo $title ?>">
          </td>
        </tr>
        <tr>
          <td>Current Image: </td>
          <td>
            <?php
            if ($current_image != "") {
              //  Display the Image
            ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="150px">
            <?php
            } else {
              // Display Message
              echo "<div class='text-error'> Image not Added. </div>";
            }
            ?>
          </td>
        </tr>
        <tr>
          <td>New Image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>
        <tr>
          <td>Featured: </td>
          <td>
            <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
            <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
          </td>
        </tr>
        <tr>
          <td>Active: </td>
          <td>
            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <!-- Form end -->