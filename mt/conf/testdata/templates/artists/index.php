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

$sql = "select id, name, image, description, date_format(date_modified, '%b %d, %Y %h:%i %p') from " . $_mt['tblprefix'] . "artists order by rand() asc";
$st = $conn->prepare($sql);
$st->execute();
$results = $st->fetchAll(PDO::FETCH_NUM);
$json = json_encode($results);

?>

<script>
  var artists_data_obj = {
    data: <?php echo $json; ?>,
    order: [[ 4, "desc" ]],
    columns: [
      { title: "ID", visible: false },
      { title: "Name", data: function(row){ 
        return '<div class="title-wrap"><a href="/<?php echo $_mt['server_path']; ?>/artists/edit/?id=' + row[0] + '">' + row[1] + '</a></div>';
      }},
      { title: "", orderable: false, data: function(row){ 
        var imgParts = row[2].split('/');
        imgParts.splice(imgParts.length - 1, 0, 'thumbnail');
        var thumbSrc = imgParts.join('/');
        return '<div class="img-wrap"><a href="/<?php echo $_mt['server_path']; ?>/artists/edit/?id=' + row[0] + '"><img src="/<?php echo $_mt['server_path']; ?>/uploads/' + thumbSrc + '" /></a></div>'; 
      }},
      { title: "Info", orderable: false, data: function(row){
        return '<div class="info">' + row[3] + '</div>';
      }},
      { title: "Modified", data: function(row){
        var lastmod = row[4] ? row[4] : "";
        return '<div class="lastmod">' + lastmod + '</div>';
      }}
    ],
    paging: false
  };
</script>

<div class="index">
  
  <?php echo $deleteAlert; ?>

  <h1>Artists</h1>
  
  <ul class="tabs" data-tab>
    <li class="tab-title <?php if(!isset($_COOKIE['mtIndexView']) || $_COOKIE['mtIndexView'] == 'Grid View') echo 'active'; ?>"><a title="Grid View" href="#grid-view"><i class="fa fa-th"></i></a></li>
    <li class="tab-title <?php if(isset($_COOKIE['mtIndexView']) && $_COOKIE['mtIndexView'] == 'List View') echo 'active'; ?>"><a title="List View" href="#list-view"><i class="fa fa-list"></i></a></li>
  </ul>

  <div class="tabs-content">
    
    <div class="content <?php if(!isset($_COOKIE['mtIndexView']) || $_COOKIE['mtIndexView'] == 'Grid View') echo 'active'; ?>" id="grid-view">
      <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
        <?php foreach($results as $result): ?>
          <?php 
            $imgParts = explode('/', $result[2]);
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
    
    <div class="content <?php if(isset($_COOKIE['mtIndexView']) && $_COOKIE['mtIndexView'] == 'List View') echo 'active'; ?>" id="list-view">
      <table class="smart-table" data-dataobj="artists" width="100%"></table>
    </div>

  </div>

  <p class="text-center"><a class="button" href="/<?php echo $_mt['server_path']; ?>/artists/create/"><i class="fa fa-plus"></i> Create New Artist</a></p>
</div>