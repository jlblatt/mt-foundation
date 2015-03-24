<?php 

  global $conn;

  if(isset($_POST['submit']))
  {
    $sql = "insert into " . $_mt['tblprefix'] . "songs 
      (title, album_id, track_no, date_created, date_modified)
        values
      (:title, :album_id, :track_no, now(), now())";
    
    $st = $conn->prepare($sql);
    $st->bindValue(":title", $_POST['f_title'], PDO::PARAM_STR);
    $st->bindValue(":album_id", $_POST['f_album_id'], PDO::PARAM_INT);
    $st->bindValue(":track_no", $_POST['f_track_no'], PDO::PARAM_INT);
    
    if($st->execute()) 
    {
      echo '<div data-alert class="alert-box success">Song created.</div>';
      $_POST = [];
    }
    else echo '<div data-alert class="alert-box alert">Song create failed :( - Error code: ' . print_r($st->errorInfo(), true) . '</div>';
  }

  $sql = "select id, title, (select name from " . $_mt['tblprefix'] . "artists where id = artist_id) as artist, pubyear from " . $_mt['tblprefix'] . "albums order by title";
  $st = $conn->prepare($sql);
  $st->execute();
  $albums = $st->fetchAll(PDO::FETCH_NUM);
?>



<form method="post" id="create" class="clearfix">
  <h1>Create Song...</h1>

  <div class="row">
    <div class="medium-12 columns">
      <input type="text" name="f_title" placeholder="Title" required value="<?php echo isset($_POST['f_title']) ? htmlspecialchars($_POST['f_title']) : ''; ?>" />
      <input type="text" name="f_album_displayfield" class="relational" data-reveal-id="album-select" required placeholder="Select an album..." autocomplete="off" value="<?php echo isset($_POST['f_album_displayfield']) ? htmlspecialchars($_POST['f_album_displayfield']) : ''; ?>" />
      <input type="hidden" name="f_album_id" value="<?php echo isset($_POST['f_album_id']) ? htmlspecialchars($_POST['f_album_id']) : ''; ?>" required />
      <script>
        var albums_data_obj = {
          data: <?php echo json_encode($albums); ?>,
          columns: [
            { "title": "ID" },
            { "title": "Title" },
            { "title": "Artist" },
            { "title": "Year" }
          ],
          paging: false
        };
      </script>
      <div id="album-select" class="reveal-modal relational" data-reveal data-field="f_album_id">
        <table class="smart-table" data-dataobj="albums"></table>
      </div>
      <input type="number" name="f_track_no" placeholder="Track No." min="1" required value="<?php echo isset($_POST['f_track_no']) ? htmlspecialchars($_POST['f_track_no']) : ''; ?>" />
    </div>
  </div>

  <p><input type="submit" class="button" value="Save" name="submit" /><p>
</form>























