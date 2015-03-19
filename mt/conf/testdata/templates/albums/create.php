<?php 

  global $conn;

  if(isset($_POST['submit']))
  {
    $sql = "insert into " . $_mt['tblprefix'] . "albums 
      (title, image, pubyear, artist_id, date_created, date_modified)
        values
      (:title, :image, :pubyear, :artist_id, now(), now())";
    
    $st = $conn->prepare($sql);
    $st->bindValue(":title", $_POST['f_title'], PDO::PARAM_STR);
    $st->bindValue(":image", $_POST['f_image'], PDO::PARAM_STR);
    $st->bindValue(":pubyear", $_POST['f_pubyear'], PDO::PARAM_INT);
    $st->bindValue(":artist_id", $_POST['f_artist_id'], PDO::PARAM_INT);

    if($st->execute()) 
    {
      echo '<div data-alert class="alert-box success">Album created.</div>';
      $_POST = [];
    }
    else echo '<div data-alert class="alert-box alert">Album create failed :( - Error code: ' . print_r($st->errorInfo(), true) . '</div>';
  }

  $sql = "select id, name from " . $_mt['tblprefix'] . "artists order by name";
  $st = $conn->prepare($sql);
  $st->execute();
  $artists = $st->fetchAll(PDO::FETCH_ASSOC);
?>

<form method="post" id="create" class="clearfix">
  <h1>Create Album...</h1>
  
  <div class="row">
    <div class="medium-6 columns">
      <input type="text" name="f_title" placeholder="Title" required value="<?php echo isset($_POST['f_title']) ? htmlspecialchars($_POST['f_title']) : ''; ?>" />
      <select name="f_artist_id">
        <option value="">Artist...</option>
        <?php foreach($artists as $artist): ?>
          <option value="<?php echo $artist['id']; ?>"><?php echo $artist['name']; ?></option>
        <?php endforeach; ?>
      </select>
      <input type="number" name="f_pubyear" placeholder="Year" maxlength="4" required value="<?php echo isset($_POST['f_pubyear']) ? htmlspecialchars($_POST['f_pubyear']) : ''; ?>" />
    </div>
    <div class="medium-6 columns">
      <div class="image-editable unset" data-reveal-id="file-browser" data-instance-id="mtImageEdit">
        <img class="empty" <?php if(isset($_POST['f_image'])): ?>src="<?php echo htmlspecialchars($_POST['f_image']); ?>"<?php endif; ?> />
        <input type="text" name="f_image" required value="<?php echo isset($_POST['f_image']) ? htmlspecialchars($_POST['f_image']) : ''; ?>" />
      </div>
    </div>
  </div>

  <p><input type="submit" class="button" value="Save" name="submit" /><p>
</form>























