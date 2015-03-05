<?php

global $conn;

$deleteAlert = "";
if(isset($_POST['delete']) && isset($_POST['id']))
{
  $sql = "delete from " . $_mt['tblprefix'] . "artists where id = :id";
  
  $st = $conn->prepare($sql);
  $st->bindValue(":id", $_POST['id'], PDO::PARAM_INT);

  if($st->execute()) $deleteAlert = '<div data-alert class="alert-box success">Artist deleted.</div>';
  else $deleteAlert = '<div data-alert class="alert-box alert">Artist delete failed :( - Error code: ' . $st->errorInfo() . '</div>';
}

$sql = "select id, name, description, image, date_modified from " . $_mt['tblprefix'] . "artists order by date_modified desc";
$st = $conn->prepare($sql);
$st->execute();
$results = $st->fetchAll(PDO::FETCH_NUM);
$json = json_encode($results);

?>

<script>
  var artists_data_obj = {
    data: <?php echo $json; ?>,
    columns: [
      { "title": "ID" },
      { "title": "Name" },
      { "title": "Info" },
      { "title": "Thumbnail" },
      { "title": "Lastmod" }
    ],
    paging: false
  };
</script>

<div class="index">
  
  <?php echo $deleteAlert; ?>

  <ul class="tabs right" data-tab>
    <li class="tab-title active"><a title="Grid View" href="#grid-view"><i class="fa fa-th"></i><span class="show-for-small-only">&nbsp;Grid View</span></a></li>
    <li class="tab-title"><a title="List View" href="#list-view"><i class="fa fa-list"></i><span class="show-for-small-only">&nbsp;List View</span></a></li>
  </ul>

  <h1>Artists</h1>

  <div class="tabs-content">
    
    <div class="content active" id="grid-view">
      <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
        <?php foreach($results as $result): ?>
          <?php 
            $imgParts = explode('/', $result[3]);
            array_splice($imgParts, count($imgParts) - 1, 0, 'thumbnail');
            $thumbSrc = implode('/', $imgParts);
          ?>
          <li>
            <a href="/<?php echo $_mt['server_path']; ?>/artists/edit/?id=<?php echo htmlspecialchars($result[0]); ?>" title="<?php echo htmlspecialchars($result[2]); ?>">
              <img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($thumbSrc); ?>" />
              <span class="title"><?php echo htmlspecialchars($result[1]); ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    
    <div class="content" id="list-view">
      <table class="smart-table" data-dataobj="artists"></table>
    </div>

  </div>
</div>