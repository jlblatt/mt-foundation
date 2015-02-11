<?php

//take an array of artist ids, pull album/song info/assets from Discogs, and convert to SQL inserts

$artists = array(246650, 158120, 81013, 82730, 67156, 253281, 1289, 10263, 50183, 110593, 252354, 251595);
$artists = array(158120);

//api functions

function getReleasePage($artist, $page)
{
  $ch = curl_init("http://api.discogs.com/artists/" . $artist . "/releases?per_page=100&page=" . $page);
  curl_setopt($ch, CURLOPT_USERAGENT, 'MTFoundationTestDataCollector/1.0 +https://github.com/jlblatt/mt-foundation');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch); curl_close($ch);
  $releases = json_decode($result);
  return $releases;
}

function getAlbum($id)
{
  $ch = curl_init("http://api.discogs.com/masters/" . $id);
  curl_setopt($ch, CURLOPT_USERAGENT, 'MTFoundationTestDataCollector/1.0 +https://github.com/jlblatt/mt-foundation');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch); curl_close($ch);
  $album = json_decode($result);
  return $album; 
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
        $allAlbums[$artist][] = $thisRelease;
      }
    }

    if(property_exists($thisSetOfReleases->pagination->urls, "next"))
    {
      $page++;
      sleep(2);
    }

    else break;
  }

  sleep(2);
}






//build songs array
$allSongs = array();

foreach($allAlbums as $artist => $albums)
{
  foreach($albums as $album)
  {
    $thisAlbum = getAlbum($album->id);

    //stopped here
    //  need to loop over track listing and push onto songs array
    //  need to write out sql
    //  need to download images

    sleep(2);
  }
}
