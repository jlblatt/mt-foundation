<?php 

  global $conn;

  if(isset($_POST['submit']) && isset($_POST['id']))
  {
    $sql = "insert into " . $_mt['tblprefix'] . "artists 
      (name, description, image, date_created, date_modified)
        values
      (:name, :description, :image, now(), now())";
    
    $st = $conn->prepare($sql);
    //$st->bindValue(":id", $_GET['id'], PDO::PARAM_INT);
    $st->bindValue(":name", $_POST['f_name'], PDO::PARAM_STR);
    $st->bindValue(":description", $_POST['f_description'], PDO::PARAM_STR);
    $st->bindValue(":image", $_POST['f_image'], PDO::PARAM_STR);

    if($st->execute()) echo '<div data-alert class="alert-box success">Artist created.</div>';
    else echo '<div data-alert class="alert-box alert">Artist create failed :( - Error code: ' . $st->errorInfo() . '</div>';
  }

?>

<form method="post" id="add" class="clearfix">
  <h1>Create Artist...</h1>
  
  <div class="image-editable" data-reveal-id="file-browser" data-instance-id="mtImageEdit">
    <img class="empty" src="<?php echo htmlspecialchars($_POST['f_image']); ?>" />
    <input type="hidden" name="f_image" required value="<?php echo htmlspecialchars($_POST['f_image']); ?>" />
  </div>
  
  <div class="row">
    <input type="text" name="f_name" placeholder="Name" required value="<?php echo htmlspecialchars($_POST['f_name']); ?>" />
  </div>

  <div class="row">
    <textarea name="f_description" placeholder="Description" required><?php echo htmlspecialchars($_POST['f_description']); ?></textarea>
  </div>
  
  <p><input type="submit" class="button" value="Save" name="submit" /><p>
</form>























