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
            <input <?php if ($featured == "Yes") {
                      echo "checked";
                    } ?> type="radio" name="featured" value="Yes"> Yes
            <input <?php if ($featured == "No") {
                      echo "checked";
                    } ?> type="radio" name="featured" value="No"> No
          </td>
        </tr>
        <tr>
          <td>Active: </td>
          <td>
            <input <?php if ($active == "Yes") {
                      echo "checked";
                    } ?> type="radio" name="active" value="Yes">Yes
            <input <?php if ($active == "No") {
                      echo "checked";
                    } ?> type="radio" name="active" value="No">No
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
  </div>
</div>
<?php
//Check if the submit button is click or not
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $featured=$_POST['featured'];
  $active=$_POST['active'];
  // Check the uimage is select or no
  if (isset($_FILES['image']['name'])) {
    // Upload the Image
    // To upload the image we need image name, source path and destination_path
    $image_name = $_FILES['image']['name'];
    //Auto rename
    //get tje extension of our imager ex png, jpg
    if($image_name !=""){
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
    }
    else{

    }
  } else {
    // Don't upload
    $image_name = $current_image;
  }
  // Create sql
  $sql1="UPDATE tbl_category SET title='$title',featured='$featured',active='$active',image_name='$image_name' WHERE id='$id' ";
  $res=mysqli_query($conn,$sql1);
   if($res==True){
    $_SESSION['update'] = " <div class='succes-error'> Update Category Succesfully";
    header("location:" . SITEURL . 'admin/manage-category.php');
   }
   else{
    $_SESSION['update'] = "<div class='text-error'> Failed to Category Admin";
    header("location:" . SITEURL . 'admin/category-admin.php');
   }
}
?>
<?php include('./partials/footer.php') ?>