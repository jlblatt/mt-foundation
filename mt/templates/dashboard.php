<?php

$sql = "select 
    id, 
    name, 
    image 
  from " . $_mt['tblprefix'] . "artists 
  order by date_modified desc 
  limit 5";

$st = $conn->prepare($sql);
$st->execute();
$artists = $st->fetchAll(PDO::FETCH_ASSOC);



$sql = "select 
    " . $_mt['tblprefix'] . "albums.id, 
    title, 
    " . $_mt['tblprefix'] . "albums.image, 
    " . $_mt['tblprefix'] . "artists.name as artist_name, 
    pubyear 
  from " . $_mt['tblprefix'] . "albums 
    inner join " . $_mt['tblprefix'] . "artists 
    on " . $_mt['tblprefix'] . "albums.artist_id = " . $_mt['tblprefix'] . "artists.id 
  order by " . $_mt['tblprefix'] . "albums.date_modified desc 
  limit 5";

$st = $conn->prepare($sql);
$st->execute();
$albums = $st->fetchAll(PDO::FETCH_ASSOC);




$sql = "select 
    " . $_mt['tblprefix'] . "songs.id, 
    " . $_mt['tblprefix'] . "songs.title,
    " . $_mt['tblprefix'] . "albums.title as album_title
  from " . $_mt['tblprefix'] . "songs 
    inner join " . $_mt['tblprefix'] . "albums
    on " . $_mt['tblprefix'] . "songs.album_id = " . $_mt['tblprefix'] . "albums.id 
  order by " . $_mt['tblprefix'] . "songs.date_modified desc 
  limit 5";

$st = $conn->prepare($sql);
$st->execute();
$songs = $st->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="dashboard">

  <div class="row">
    <div class="small-12 columns no-drop">
      <?php 
        $greeting = "Hello";
        date_default_timezone_set('America/New_York');
        $localtime = localtime();
        if($localtime[2] < 4) $greeting = "Get to bed &#3232;_&#3232;";
        else if($localtime[2] >= 4 && $localtime[2] < 12) $greeting = "Good morning!";
        else if($localtime[2] >= 12 && $localtime[2] < 17) $greeting = "Good afternoon!";
        else if($localtime[2] >= 17) $greeting = "Good evening!";
      ?>
      <h1><?php echo $greeting; ?></h1><hr />
    </div>
  </div>

  <div class="row grid">
    <div class="small-12 medium-6 columns">
      <div class="panel callout" data-dash-id="1">
        <div class="title"><strong>Welcome to mt-foundation</strong> <i class="fa fa-smile-o"></i><hr /></div>
        <p>This project's goal was to create a framework for quickly setting up very simple custom CMS's, and to learn more about Zurb's <a href="http://foundation.zurb.com/" target="_blank">Foundation</a>.</p>
        <p>If you insalled the test data bundled with the project, you should be able to browse and edit a small collection of music I've scraped from <a href="http://www.discogs.com/" target="_blank">Discogs</a>.</p> 
        <p>Have fun, and visit <a href="https://github.com/jlblatt/mt-foundation" target="_blank">mt-foundation</a> on Github for more info.</p>
      </div>
      <div class="panel" data-dash-id="2">
        <div class="title"><strong>Recent Songs</strong><hr /></div>
        <ul>
          <?php foreach($songs as $song): ?>
            <li><i class="fa fa-music"></i> <a href="/<?php echo $_mt['server_path']; ?>/songs/edit/?id=<?php echo $song['id']; ?>"><?php echo $song['title']; ?></a> - <?php echo $song['album_title']; ?></li>
          <?php endforeach; ?>
          <li><a href="/<?php echo $_mt['server_path']; ?>/songs/"><strong>View All</strong></a></li>
        </ul>
      </div>
    </div>
    <div class="small-12 medium-6 columns">
      <div class="panel" data-dash-id="3">
        <div class="title"><strong>Recent Artists</strong><hr /></div>
        <ul>  
          <?php foreach($artists as $artist): ?>
            <?php 
              $imgParts = explode('/', $artist['image']);
              array_splice($imgParts, count($imgParts) - 1, 0, 'thumbnail');
              $thumbSrc = implode('/', $imgParts);
            ?>
            <li><a href="/<?php echo $_mt['server_path']; ?>/artists/edit/?id=<?php echo $artist['id']; ?>"><img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($thumbSrc); ?>" /><?php echo $artist['name']; ?></a></li>
          <?php endforeach; ?>
          <li><a href="/<?php echo $_mt['server_path']; ?>/artists/"><strong>View All</strong></a></li>
        </ul>
      </div>
      <div class="panel" data-dash-id="4">
        <div class="title"><strong>Recent Albums</strong><hr /></div>
        <ul>
          <?php foreach($albums as $album): ?>
            <?php 
              $imgParts = explode('/', $album['image']);
              array_splice($imgParts, count($imgParts) - 1, 0, 'thumbnail');
              $thumbSrc = implode('/', $imgParts);
            ?>
            <li><a href="/<?php echo $_mt['server_path']; ?>/albums/edit/?id=<?php echo $album['id']; ?>"><img src="/<?php echo $_mt['server_path']; ?>/uploads/<?php echo htmlspecialchars($thumbSrc); ?>" /><?php echo $album['title']; ?></a> - <?php echo $album['artist_name']; ?> - <?php echo $album['pubyear']; ?></li>
          <?php endforeach; ?>
          <li><a href="/<?php echo $_mt['server_path']; ?>/albums/"><strong>View All</strong></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
