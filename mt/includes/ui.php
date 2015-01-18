<div id="set-wallpaper" class="reveal-modal" data-reveal>
  <?php imageBrowser('wallpaper'); ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php function imageBrowser($id) { ?>
  <?php
    
    $id = preg_replace("/[^\w\-\/]/", "", $id);

    if(isset($_POST['imageupload']) && isset($_POST[$id]))
    {
      $uploadSuccess = false;
      $uploadMessage = '';
      $target_file_orig = "img/uploads/" . basename($_FILES["imagefile"]["name"]);
      $target_file = "img/uploads/" . basename($_FILES["imagefile"]["name"]);
      $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
      
      $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
      if(!$check) $uploadMessage = "File is not an image.";
      if($_FILES["imagefile"]["size"] > 5000000) $uploadMessage = "Sorry, your file is too large.";
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) $uploadMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      
      $i = 2;
      while(file_exists($target_file)) 
      {
        $target_file = preg_replace("/(\.\w+$/)", "-" . $i . "$1", $target_file_orig);
        $i++;
      }

      if(!$uploadMessage) 
      {
        if(move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file)) 
        {
          $uploadSuccess = true;
          $uploadMessage = "The file ". basename( $_FILES["imagefile"]["name"]). " has been uploaded.";
        } 
        else 
        {
          $uploadMessage = "Sorry, there was an error uploading your file.";
        }
      }
    }
  ?>

  <?php if($uploadMessage): ?>
    <div data-alert class="alert-box <?php if($uploadSuccess) echo 'success'; else echo 'alert'; ?>">
      <?php echo $uploadMessage; ?>
    </div>
  <?php endif; ?>
  
  <h1>Choose an image...</h1>
  <p>No uploads yet!</p>
  <p class="lead">Upload a new image:</p>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="imageupload" />
    <input type="hidden" name="<?php echo $id; ?>" />
    <input type="file" name="imagefile" />
    <input type="submit" value="Upload" class="button" />
  </form>
<?php } ?>