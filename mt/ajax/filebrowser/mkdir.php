<?php

  $dir = "../../uploads";

  if(isset($_GET['path']))
  {
    $path = $_GET['path'];
    $path = str_replace("..", "", $path);
    $dir .= $path;
  }

  echo $dir;

  mkdir($dir, 0755, true);
?>
