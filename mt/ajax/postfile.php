<?php header('Content-Type: application/json');

  $result = array();
  $uploadSuccess = false;
  $uploadMessage = '';

  print_r($_FILES);
  if(isset($_FILES))
  {
    $target_file_orig = "img/uploads/" . basename($_FILES["imagefile"]["name"]);
    $target_file = "img/uploads/" . basename($_FILES["imagefile"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    
    $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
    if(!$check) $uploadMessage = "File is not an image.";
    else if($_FILES["imagefile"]["size"] > 5000000) $uploadMessage = "Sorry, your file is too large.";
    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) $uploadMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    
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
        $uploadMessage = "The file ". basename( $_FILES["imagefile"]["name"]) . " has been uploaded.";
      } 
      else 
      {
        $uploadMessage = "Sorry, there was an error uploading your file.";
      }
    }
  }

  if($uploadSuccess) $result = array("success" => true, "status" => 'success', "msg" => $uploadMessage);
  else $result = array("success" => false, "status" => 'alert', "msg" => $uploadMessage);

  echo json_encode($result);
?>