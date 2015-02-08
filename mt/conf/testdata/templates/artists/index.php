<?php

global $conn;

$sql = "select id, name, description, thumbnail, date_modified from " . $_mt['tblprefix'] . "artists order by date_modified desc";
$st = $conn->prepare($sql);
$st->execute();
$results = $st->fetchAll(PDO::FETCH_NUM);
$json = json_encode($results);

?>

<script>
  var artists =  <?php echo $json; ?>;
  var artists_columns = [
    { "title": "ID" },
    { "title": "Name" },
    { "title": "Info" },
    { "title": "Thumbnail" },
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
      <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
        <?php foreach($results as $result): ?>
          <li><a href="/<?php echo $_mt['server_path']; ?>/artists/edit/<?php echo htmlspecialchars($result[0]); ?>" title="<?php echo htmlspecialchars($result[2]); ?>"><img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($result[3]); ?>" /><span class="title"><?php echo htmlspecialchars($result[1]); ?></span></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    
    <div class="content" id="list-view">
      <table data-json="artists"></table>
    </div>

  </div>
</div>