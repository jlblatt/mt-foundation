<?php

//take an array of artist ids, pull album/song info/assets from Discogs, and convert to SQL inserts

$artists = array(246650, 158120, 81013, 82730, 67156, 253281, 1289, 10263, 50183, 110593, 252354, 251595);

$sql = "";

//api functions

function getReleasePage($artist, $page)
{
  sleep(2);
  $ch = curl_init("http://api.discogs.com/artists/" . $artist . "/releases?per_page=100&page=" . $page);
  curl_setopt($ch, CURLOPT_USERAGENT, 'MTFoundationTestDataCollector/1.0 +https://github.com/jlblatt/mt-foundation');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1);
  curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 60);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  $result = curl_exec($ch); curl_close($ch);
  $releases = json_decode($result);
  return $releases;
}

function getAlbum($id)
{
  sleep(2);
  $ch = curl_init("https://api.discogs.com/masters/" . $id . "?key=xxx&secret=yyy");
  curl_setopt($ch, CURLOPT_USERAGENT, 'MTFoundationTestDataCollector/1.0 +https://github.com/jlblatt/mt-foundation');
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1);
  curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 60);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  $result = curl_exec($ch); curl_close($ch);
  $album = json_decode($result);
  return $album; 
}

function getImage($url, $fn)
{
  sleep(2);
  $ext = preg_replace("/.*(\.\w\w\w\w?)$/", "$1", $url);
  $ch = curl_init($url);
  $fp = fopen('images/' . $fn . $ext, 'w');
  curl_setopt($ch, CURLOPT_USERAGENT, 'MTFoundationTestDataCollector/1.0 +https://github.com/jlblatt/mt-foundation');
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1);
  curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 60);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_FILE, $fp);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_exec($ch); curl_close($ch); fclose($fp);
  return $fn . $ext;
}





//build albums array 
$allAlbums = array();

foreach($artists as $artist)
{
  $albums[$artist] = array();
  $page = 1;
  while(true)
  {
    $thisSetOfReleases = getReleasePage($artist, $page);
    foreach($thisSetOfReleases->releases as $thisRelease)
    {
      if($thisRelease->type == "master" && $thisRelease->role == "Main")
      {
        $allAlbums[$artist][] = getAlbum($thisRelease->id);
      }
    }

    if(property_exists($thisSetOfReleases->pagination->urls, "next"))
    {
      $page++;
    }

    else break;
  }
}





//download images
foreach($allAlbums as $artist => $albums)
{
  foreach($albums as $album)
  {
    if(property_exists($album, "images") && count($album->images))
    {
      $prim = 0;
      foreach($album->images as $index => $image)
      {
        if($image->type == "primary")
        {
          $prim = $index;
        }
      }
      $album->imagename = getImage($album->images[$prim]->resource_url, $album->id);
    }
  }
}





//build songs array
$allSongs = array();

foreach($allAlbums as $artist => $albums)
{
  foreach($albums as $album)
  {
    foreach($album->tracklist as $num => $song)
    {
      $song->num = $num + 1;
      $song->album_id = $album->id;
      $allSongs[] = $song;
    }
  }
}





//generate sql
$sql .= "# albums ##################################\n\n";
foreach($allAlbums as $artist => $albums)
{
  foreach($albums as $album)
  {
    $sql .= sprintf("insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (%u, '%s', '%s', %u, %u, now(), now());\n",
      $album->id,
      sqlescape($album->title),
      sqlescape('albums/' . $album->imagename),
      $album->year,
      $artist
    );
  }
}

$sql .= "\n# songs ###################################\n\n";
foreach($allSongs as $song)
{
  $sql .= sprintf("insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('%s', %u, %u, now(), now());\n",
    sqlescape($song->title),
    $song->num,
    $song->album_id
  );
}

//echo $sql;
file_put_contents("data.sql", $sql);

echo "Done!";





//mysql_real_escape_string replacement since we aren't worried about injection
//http://evertpot.com/escaping-mysql-strings-with-no-connection-available/
function sqlescape($unescaped) {
  $replacements = array(
     "\x00"=>'\x00',
     "\n"=>'\n',
     "\r"=>'\r',
     "\\"=>'\\\\',
     "'"=>"\'",
     '"'=>'\"',
     "\x1a"=>'\x1a'
  );
  return strtr($unescaped,$replacements);
}

