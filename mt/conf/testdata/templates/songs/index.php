<?php

global $conn;

$deleteAlert = "";
if(isset($_POST['delete']) && isset($_POST['id']))
{
  $sql = "delete from " . $_mt['tblprefix'] . "songs where id = :id";
  
  $st = $conn->prepare($sql);
  $st->bindValue(":id", $_POST['id'], PDO::PARAM_INT);

  if($st->execute()) $deleteAlert = '<div data-alert class="alert-box success">Song deleted.</div>';
  else $deleteAlert = '<div data-alert class="alert-box alert">Song delete failed :( - Error code: ' . $st->errorInfo() . '</div>';
}

$sql = "select id, title, (select title from " . $_mt['tblprefix'] . "albums where id = album_id), (select artist_id from " . $_mt['tblprefix'] . "albums where id = album_id) as artist_id, (select name from " . $_mt['tblprefix'] . "artists where id = artist_id) as artist, track_no, date_modified from " . $_mt['tblprefix'] . "songs order by date_modified desc";
$st = $conn->prepare($sql);
$st->execute();
$results = $st->fetchAll(PDO::FETCH_NUM);
$json = json_encode($results);

?>

<script>
  var albums_data_obj = {
    data: <?php echo $json; ?>,
    columns: [
      { "title": "ID" },
      { "title": "Title" },
      { "title": "Album" },
      { "title": "Artist ID" },
      { "title": "Artist" },
      { "title": "Track No." },
      { "title": "Lastmod" }
    ],
    paging: false
  };
</script>

<div class="index">
  
  <?php echo $deleteAlert; ?>

  <h1>Songs</h1>
    
  <div class="content" id="list-view">
    <table data-dataobj="albums"></table>
  </div>

</div>