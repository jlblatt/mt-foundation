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
      artist_id = :artist_id,
      pubyear = :pubyear,
      image = :image,
      date_modified = now()
    where id = :id";
    
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $_GET['id'], PDO::PARAM_INT);
    $st->bindValue(":title", $_POST['f_title'], PDO::PARAM_STR);
    $st->bindValue(":artist_id", $_POST['f_artist_id'], PDO::PARAM_INT);
    $st->bindValue(":pubyear", $_POST['f_pubyear'], PDO::PARAM_STR);
    $st->bindValue(":image", $_POST['f_image'], PDO::PARAM_STR);

    if($st->execute()) echo '<div data-alert class="alert-box success">Album updated.</div>';
    else echo '<div data-alert class="alert-box alert">Album update failed :( - Error code: ' . $st->errorInfo()[2] . '</div>';
  }

  $sql = "select *, (select name from " . $_mt['tblprefix'] . "artists where id = artist_id) as artist from " . $_mt['tblprefix'] . "albums where id = :id";
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

<?php 
  $sql = "select id, name from " . $_mt['tblprefix'] . "artists order by name";
  $st = $conn->prepare($sql);
  $st->execute();
  $results = $st->fetchAll(PDO::FETCH_NUM);
  $artists = $results;
?>

<form method="post" id="edit" class="clearfix">    
  <div class="image-editable" data-reveal-id="file-browser" data-instance-id="mtImageEdit">
    <img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($album['image']); ?>" />
    <input type="hidden" name="f_image" value="<?php echo htmlspecialchars($album['image']); ?>" />
  </div>
  
  <h1 class="field-editable" data-field="f_title"><?php echo $album['title']; ?></h1>
  <input type="hidden" name="f_title" value="<?php echo htmlspecialchars($album['title']); ?>" />

  <h5 class="field-editable strong relational" data-reveal-id="artist-select"><?php echo $album['artist']; ?></h5>
  <input type="hidden" name="f_artist_id" value="<?php echo htmlspecialchars($album['artist_id']); ?>" />

  <script>
    var artists_data_obj = {
      data: <?php echo json_encode($artists); ?>,
      columns: [
        { "title": "ID" },
        { "title": "Name" }
      ],
      paging: false
    };
  </script>

  <div id="artist-select" class="reveal-modal relational" data-reveal data-field="f_artist_id">
    <table class="smart-table" data-dataobj="artists"></table>
  </div>
  
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
  <ul class="track-list">
    <?php foreach($results as $result): ?>
      <li><?php echo $result['track_no']; ?>) <a href="/<?php echo $_mt['server_path']; ?>/songs/edit/?id=<?php echo htmlspecialchars($result['id']); ?>" title="<?php echo htmlspecialchars($result['title']); ?>"><?php echo htmlspecialchars($result['title']); ?></a></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post" action="/<?php echo $_mt['server_path']; ?>/albums/" class="confirm-delete" data-type="album">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <p>&nbsp;</p>
  <p class="text-center"><input type="submit" class="button alert" value="Delete This Album" name="delete" /><p>
</form>























