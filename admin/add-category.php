<?php include('./partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
    <br><br><br>
    <?php
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    ?>
    <!-- Add category Form -->
    <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" placeholder="Category Title">
          </td>
        </tr>
        <tr>
          <td>Select Image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>
        <tr>
          <td>Featured: </td>
          <td>
            <input type="radio" name="featured" value="Yes"> Yes
            <input type="radio" name="featured" value="No"> No
          </td>
        </tr>
        <tr>
          <td>Active: </td>
          <td>
            <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <!-- Form end -->
    <?php
    // Check if the submit button is Clicked or not
    if (isset($_POST['submit'])) {
      // 1.Get the Value from Form
      $title = $_POST['title'];

      // For radio input, we need to check whether the button is selected or not
      if (isset($_POST['featured'])) {
        //Get the value from Form 
        $featured = $_POST['featured'];
      } else {
        // Set Default value
        $featured = "No";
      }
      if (isset($_POST['active'])) {
        $active = $_POST['active'];
      } else {
        $active = "No";
      }

      // Check the uimage is select or no
      if (isset($_FILES['image']['name'])) {
        // Upload the Image
        // To upload the image we need image name, source path and destination_path
        $image_name = $_FILES['image']['name'];
        //Auto rename
        //get tje extension of our imager ex png, jpg
        $ext = explode('.', $image_name);
        $ext = end($ext);
        // Rename the Image
        $image_name ="Food_category_" . rand(000, 999) . '.' . $ext;
        echo $image_name;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/" . $image_name;
        // Upload image
        $upload = move_uploaded_file($source_path, $destination_path);
        // Check image upload or not
        // If image is not upload then we will stop process and redirect error message
        if ($upload == false) {
          // Set message
          $_SESSION['upload'] = " <div class='text-error'> Failed to Upload Image Category</div>";
          // redirect error message
          header('location:' . SITEURL . 'admin/add-category.php');
          // Stop procces
          die();
        }
      } else {
        // Don't upload
        $image_name = "";
      }

      // 2.Creat SQL insert
      $sql = "INSERT INTO tbl_category SET title='$title' ,image_name='$image_name',featured='$featured ', active='$active' ";
      // 3. Excute Querry and Save in Database
      $res = mysqli_query($conn, $sql);
      // 4. Check Querry
      if ($res = true) {
        $_SESSION['add'] = " <div class='text-succes'>Category Added Successfully! </div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      } else {
        $_SESSION['add'] = " <div class='text-error'> Failed to Add Category</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      }
    }
    ?>
  </div>
</div>
<?php include('./partials/footer.php') ?>