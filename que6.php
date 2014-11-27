<?php
/**
 * getAllDirAndFiles - Reads all files and folders using recursive funciton
 * @rootDir -  starts reading the path from root directory.
 */ 
function getAllDirAndFiles($rootDir) {
    $directory = scandir($rootDir);     
    foreach( $directory as $key => $name ) {
        if ( $name != "." && $name != "..") {  // no need for current and parent directory
            $childDirName = $rootDir.DIRECTORY_SEPARATOR.$name;
            if(!is_dir($childDirName)) {
               echo " <li> $name </li>";
            } else {
                echo " <li><span style='background-color: aquamarine;padding: 0 5px;'> $name </span> </li>";
                echo "<ul>";
                getAllDirAndFiles($childDirName);
            }
        }
    }
    echo "</ul>";
}
$path    = 'uploads/';
echo "<ul>";
getAllDirAndFiles($path);

?>