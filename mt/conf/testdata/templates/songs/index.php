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

$sql = "select id, title, album_id, (select title from " . $_mt['tblprefix'] . "albums where id = album_id), (select artist_id from " . $_mt['tblprefix'] . "albums where id = album_id) as artist_id, (select name from " . $_mt['tblprefix'] . "artists where id = artist_id) as artist, track_no, date_format(date_modified, '%b %d, %Y %h:%i %p') from " . $_mt['tblprefix'] . "songs order by rand()";
$st = $conn->prepare($sql);
$st->execute();
$results = $st->fetchAll(PDO::FETCH_NUM);
$json = json_encode($results);

?>

<script>
  var songs_data_obj = {
    data: <?php echo $json; ?>,
    order: [[ 7, "desc" ]],
    columns: [
      { title: "ID", visible: false },
      { title: "Title", data: function(row){
        return '<div class="title-wrap"><a href="/<?php echo $_mt['server_path']; ?>/songs/edit/?id=' + row[0] + '">' + row[1] + '</a></div>';
      }},
      { title: "Album ID", visible: false },
      { title: "Album", data: function(row){
        return '<a href="/<?php echo $_mt['server_path']; ?>/albums/edit/?id=' + row[2] + '">' + row[3] + '</a>';
      }},
      { title: "Artist ID", visible: false },
      { title: "Artist", data: function(row){
        return '<a href="/<?php echo $_mt['server_path']; ?>/artists/edit/?id=' + row[4] + '">' + row[5] + '</a>';
      }},
      { title: "Track No." },
      { title: "Modified", data: function(row){
        var lastmod = row[7] ? row[7] : "";
        return '<div class="lastmod">' + lastmod + '</div>';
      }}
    ],
    paging: false
  };
</script>

<div class="index">
  
  <?php echo $deleteAlert; ?>

  <h1>Songs</h1>
    
  <div class="content" id="list-view">
    <table class="smart-table" data-dataobj="songs" width="100%"></table>
  </div>

</div>