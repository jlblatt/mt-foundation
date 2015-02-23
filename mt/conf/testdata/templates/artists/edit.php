<?php 

  if(!isset($_GET['id'])) 
  { 
    header('Location: http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/' . $_mt['server_path'] . '/artists/'); 
    return; 
  } 

  global $conn;

  if(isset($_POST['submit']))
  {
    $sql = "update " . $_mt['tblprefix'] . "artists set 
      name = :name,
      description = :description,
      date_modified = now()
    where id = :id";
    
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $_GET['id'], PDO::PARAM_INT);
    $st->bindValue(":name", $_POST['f_name'], PDO::PARAM_STR);
    $st->bindValue(":description", $_POST['f_description'], PDO::PARAM_STR);

    if($st->execute()) echo '<div data-alert class="alert-box success">Artist updated.</div>';
    else echo '<div data-alert class="alert-box alert">Artist update failed :( - Error code: ' . $st->errorInfo() . '</div>';

  }

  $sql = "select * from " . $_mt['tblprefix'] . "artists where id = :id";
  $st = $conn->prepare($sql);
  $st->bindValue(":id", $_GET['id'] ,PDO::PARAM_INT);
  $st->execute();
  $results = $st->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if(!$results): ?>
  <div data-alert class="alert-box alert">Artist not found :(</div>
  <p class="right"><a href="/<?php echo $_mt['server_path']; ?>/artists/">Back to Artists Index</a></p>
  <?php return; ?>
<?php endif; ?>

<?php $artist = $results[0]; ?>

<form method="post" id="edit">    
  <div class="image">
    <img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($artist['image']); ?>" />
    <input type="hidden" name="f_image" value="<?php echo htmlspecialchars($artist['image']); ?>" />
  </div>
  
  <h1 class="field-editable" data-field="f_name"><?php echo $artist['name']; ?></h1>
  <input type="hidden" name="f_name" value="<?php echo htmlspecialchars($artist['name']); ?>" />
  
  <p class="field-editable" data-field="f_description"><?php echo $artist['description']; ?></p>
  <input type="hidden" name="f_description" value="<?php echo htmlspecialchars($artist['description']); ?>" />
  
  <p><input type="submit" class="button secondary disabled" value="Save" name="submit" /><p>
</form>

<?php
  
  $albumText = '<h2>Albums by ' . $artist['name'] . '</h2>';

  $sql = "select * from " . $_mt['tblprefix'] . "albums where artist_id = :id";
  $st = $conn->prepare($sql);
  $st->bindValue(":id", $_GET['id'] ,PDO::PARAM_INT);
  $st->execute();
  $results = $st->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if($results) echo $albumText; ?>

<div id="grid-view" class="related">
  <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
    <?php foreach($results as $result): ?>
      <li><a href="/<?php echo $_mt['server_path']; ?>/albums/edit/?id=<?php echo htmlspecialchars($result['id']); ?>" title="<?php echo htmlspecialchars($result['title']); ?>"><img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($result['thumbnail']); ?>" /><span class="title"><?php echo htmlspecialchars($result['title']); ?></span></a></li>
    <?php endforeach; ?>
  </ul>  
</div>






















