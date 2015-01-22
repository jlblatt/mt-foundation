<?php

  $dir = "../../uploads/";
  $files = array();

  if (is_dir($dir))
  {
    if($dh = opendir($dir))
    {
      while(($file = readdir($dh)) !== false)
      {
        if($file != '.' && $file != '..' && $file != 'thumbnail')
        {
          $files[] = $file;
        }
      }
        
      closedir($dh);
    }
  }

  echo json_encode($files);
?>
