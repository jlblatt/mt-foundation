<?php

global $conn;

$sql = "select name, description, image, date_modified from " . $_mt['tblprefix'] . "artists order by date_modified desc";
$st = $conn->prepare($sql);
$st->execute();
$results = $st->fetchAll(PDO::FETCH_NUM);
$json = json_encode($results);

?>

<script>
  var artists =  <?php echo $json; ?>;
  var artists_columns = [
    { "title": "Name" },
    { "title": "Info" },
    { "title": "Image" },
    { "title": "Lastmod" }
  ];
</script>

<div class="index">
  <ul class="tabs right" data-tab>
    <li class="tab-title active"><a title="Grid View" href="#grid-view"><i class="fa fa-th"></i><span class="show-for-small-only">&nbsp;Grid View</span></a></li>
    <li class="tab-title"><a title="List View" href="#list-view"><i class="fa fa-list"></i><span class="show-for-small-only">&nbsp;List View</span></a></li>
  </ul>

  <h1>Artists</h1>

  <div class="tabs-content">
    
    <div class="content active" id="grid-view">
      <p>Grid View</p>
    </div>
    
    <div class="content" id="list-view">
      <table data-json="artists"></table>
    </div>

  </div>
</div>