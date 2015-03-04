<?php 

  if(!isset($_GET['id'])) 
  { 
    header('Location: http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/' . $_mt['server_path'] . '/albums/'); 
    return; 
  } 

  global $conn;

  if(isset($_POST['submit']) && isset($_GET['id']))
  {
    $sql = "update " . $_mt['tblprefix'] . "albums set 
      title = :title,
      pubyear = :pubyear,
      image = :image,
      date_modified = now()
    where id = :id";
    
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $_GET['id'], PDO::PARAM_INT);
    $st->bindValue(":title", $_POST['f_title'], PDO::PARAM_STR);
    $st->bindValue(":pubyear", $_POST['f_pubyear'], PDO::PARAM_STR);
    $st->bindValue(":image", $_POST['f_image'], PDO::PARAM_STR);

    if($st->execute()) echo '<div data-alert class="alert-box success">Album updated.</div>';
    else echo '<div data-alert class="alert-box alert">Album update failed :( - Error code: ' . $st->errorInfo() . '</div>';
  }

  $sql = "select * from " . $_mt['tblprefix'] . "albums where id = :id";
  $st = $conn->prepare($sql);
  $st->bindValue(":id", $_GET['id'] ,PDO::PARAM_INT);
  $st->execute();
  $results = $st->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if(!$results): ?>
  <div data-alert class="alert-box alert">Album not found :(</div>
  <p class="right"><a href="/<?php echo $_mt['server_path']; ?>/artists/">Back to Album Index</a></p>
  <?php return; ?>
<?php endif; ?>

<?php $album = $results[0]; ?>

<form method="post" id="edit" class="clearfix">    
  <div class="image-editable" data-reveal-id="file-browser" data-instance-id="mtImageEdit">
    <img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($album['image']); ?>" />
    <input type="hidden" name="f_image" value="<?php echo htmlspecialchars($album['image']); ?>" />
  </div>
  
  <h1 class="field-editable" data-field="f_title"><?php echo $album['title']; ?></h1>
  <input type="hidden" name="f_title" value="<?php echo htmlspecialchars($album['title']); ?>" />
  
  <p class="field-editable year" data-field="f_pubyear"><?php echo $album['pubyear']; ?></p>
  <input type="hidden" name="f_pubyear" value="<?php echo htmlspecialchars($album['pubyear']); ?>" />
  
  <p><input type="submit" class="button secondary disabled" value="Save" name="submit" /><p>
</form>

<?php
  
  $albumText = '<h3>Track Listing</h3>';

  $sql = "select * from " . $_mt['tblprefix'] . "songs where album_id = :id order by track_no";
  $st = $conn->prepare($sql);
  $st->bindValue(":id", $_GET['id'] ,PDO::PARAM_INT);
  $st->execute();
  $results = $st->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if($results): ?>
  <?php echo $albumText; ?>
  <ol class="track-list">
    <?php foreach($results as $result): ?>
      <li><a href="/<?php echo $_mt['server_path']; ?>/songs/edit/?id=<?php echo htmlspecialchars($result['id']); ?>" title="<?php echo htmlspecialchars($result['title']); ?>"><?php echo htmlspecialchars($result['title']); ?></a></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post" action="/<?php echo $_mt['server_path']; ?>/albums/" class="confirm-delete" data-type="album">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <p>&nbsp;</p>
  <p class="text-center"><input type="submit" class="button alert" value="Delete This Album" name="delete" /><p>
</form>























