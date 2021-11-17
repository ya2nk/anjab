<?php
header('Content-Type: text/plain');

  /**
  * Changes permissions on files and directories within $dir and dives recursively
  * into found subdirectories.
  */
  function chmod_r($dir, $dirPermissions, $filePermissions) {
      $dp = opendir($dir);
       while($file = readdir($dp)) {
         if (($file == ".") || ($file == ".."))
            continue;

        $fullPath = $dir."/".$file;

         if(is_dir($fullPath)) {
            echo('DIR:' . $fullPath . "\n");
            chmod($fullPath, $dirPermissions);
            chmod_r($fullPath, $dirPermissions, $filePermissions);
         } else {
            echo('FILE:' . $fullPath . "\n");
            chmod($fullPath, $filePermissions);
         }

       }
     closedir($dp);
  }

  //0755 adalah permision untuk folder dan 0644 permision untuk file
  chmod_r('./', 0755, 0644);
?>