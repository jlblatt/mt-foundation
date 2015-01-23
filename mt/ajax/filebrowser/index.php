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
          $files[] = array(
            "name" => $file,
            "isdir" => is_dir($dir . $file)
          );
        }
      }
        
      closedir($dh);
    }
  }

  echo json_encode($files);
?>
