<?php 

  if(!isset($_GET['id'])) 
  { 
    header('Location: http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/' . $_mt['server_path'] . '/artists/'); 
    return; 
  } 

  global $conn;

  if(!isset($_POST))
  {
    //update db
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

<div id="edit">
  <form method="post">
    <div class="image"><img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($artist['image']); ?>" /></div>
    <h1><?php echo $artist['name']; ?></h1>
    <p><?php echo $artist['description']; ?></p>
    <p><input type="submit" class="button" value="Save" /><p>
  </form>
</div>






















