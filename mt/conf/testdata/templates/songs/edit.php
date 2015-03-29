<?php 

  if(!isset($_GET['id'])) 
  { 
    header('Location: http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/' . $_mt['server_path'] . '/songs/'); 
    return; 
  } 

  global $conn;

  if(isset($_POST['submit']) && isset($_GET['id']))
  {
    $sql = "update " . $_mt['tblprefix'] . "songs set 
      title = :title,
      album_id = :album_id,
      track_no = :track_no,
      date_modified = now()
    where id = :id";
    
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $_GET['id'], PDO::PARAM_INT);
    $st->bindValue(":album_id", $_POST['f_album_id'], PDO::PARAM_INT);
    $st->bindValue(":title", $_POST['f_title'], PDO::PARAM_STR);
    $st->bindValue(":track_no", $_POST['f_track_no'], PDO::PARAM_STR);

    if($st->execute()) echo '<div data-alert class="alert-box success">Song updated.</div>';
    else echo '<div data-alert class="alert-box alert">Song update failed :( - Error code: ' . $st->errorInfo() . '</div>';
  }

  $sql = "select *, (select title from " . $_mt['tblprefix'] . "albums where id = album_id) as album from " . $_mt['tblprefix'] . "songs where id = :id";
  $st = $conn->prepare($sql);
  $st->bindValue(":id", $_GET['id'] ,PDO::PARAM_INT);
  $st->execute();
  $results = $st->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if(!$results): ?>
  <div data-alert class="alert-box alert">Song not found :(</div>
  <p class="right"><a href="/<?php echo $_mt['server_path']; ?>/artists/">Back to Song Index</a></p>
  <?php return; ?>
<?php endif; ?>

<?php $song = $results[0]; ?>

<?php 
  $sql = "select id, title, (select name from " . $_mt['tblprefix'] . "artists where id = artist_id) as artist, pubyear from " . $_mt['tblprefix'] . "albums order by title";
  $st = $conn->prepare($sql);
  $st->execute();
  $results = $st->fetchAll(PDO::FETCH_NUM);
  $albums = $results;
?>

<form method="post" id="edit" class="clearfix">    
  <h1 class="field-editable" data-field="f_title"><?php echo $song['title']; ?></h1>
  <input type="hidden" name="f_title" value="<?php echo htmlspecialchars($song['title']); ?>" />

  <h5 class="field-editable strong relational" data-reveal-id="album-select"><?php echo $song['album']; ?></h5>
  <input type="hidden" name="f_album_id" value="<?php echo htmlspecialchars($album['artist_id']); ?>" />

  <script>
    var albums_data_obj = {
      data: <?php echo json_encode($albums); ?>,
      columns: [
        { title: "ID", visible: false },
        { title: "Title", data: function(row){
          return '<span class="data hide" data-field="id">' + row[0] + '</span><span class="data" data-field="name">' + row[1] + '</span>';
        }},
        { title: "Artist" },
        { title: "Year" }
      ],
      paging: false
    };
  </script>

  <div id="album-select" class="reveal-modal relational" data-reveal data-field="f_album_id">
    <table class="smart-table" data-dataobj="albums"></table>
  </div>
  
  <p class="field-editable int" data-field="f_track_no"><?php echo $song['track_no']; ?></p>
  <input type="hidden" name="f_track_no" value="<?php echo htmlspecialchars($song['track_no']); ?>" />
  
  <p><input type="submit" class="button secondary disabled" value="Save" name="submit" /><p>
</form>

<form method="post" action="/<?php echo $_mt['server_path']; ?>/songs/" class="confirm-delete" data-type="song">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <p>&nbsp;</p>
  <p class="text-center"><input type="submit" class="button alert" value="Delete This Song" name="delete" /><p>
</form>























