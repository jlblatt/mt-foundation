<?php 

  global $conn;

  if(isset($_POST['submit']))
  {
    $sql = "insert into " . $_mt['tblprefix'] . "artists 
      (name, description, image, date_created, date_modified)
        values
      (:name, :description, :image, now(), now())";
    
    $st = $conn->prepare($sql);
    $st->bindValue(":name", $_POST['f_name'], PDO::PARAM_STR);
    $st->bindValue(":description", $_POST['f_description'], PDO::PARAM_STR);
    $st->bindValue(":image", $_POST['f_image'], PDO::PARAM_STR);

    if($st->execute()) 
    {
      echo '<div data-alert class="alert-box success">Artist created.</div>';
      $_POST = [];
    }
    else echo '<div data-alert class="alert-box alert">Artist create failed :( - Error code: ' . print_r($st->errorInfo(), true) . '</div>';
  }

?>

<form method="post" id="create" class="clearfix">
  <h1>Create Artist...</h1>
  
  <div class="row">
    <div class="medium-6 columns">
      <input type="text" name="f_name" placeholder="Name" required value="<?php echo isset($_POST['f_name']) ? htmlspecialchars($_POST['f_name']) : ''; ?>" />
      <textarea name="f_description" placeholder="Description" required><?php echo isset($_POST['f_description']) ? htmlspecialchars($_POST['f_description']) : ''; ?></textarea>
    </div>
    <div class="medium-6 columns">
      <div class="image-editable unset" data-reveal-id="file-browser" data-instance-id="mtImageEdit">
        <img class="empty" src="<?php echo htmlspecialchars($_POST['f_image']); ?>" />
        <input type="text" name="f_image" required value="<?php echo isset($_POST['f_image']) ? htmlspecialchars($_POST['f_image']) : ''; ?>" />
      </div>
    </div>
  </div>

  <p><input type="submit" class="button" value="Save" name="submit" /><p>
</form>























