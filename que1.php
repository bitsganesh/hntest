<?php 
echo "<pre>",print_r($_FILES["myfile"]);
die;
$upload_dir = "uploads/";
  if (isset($_FILES["myfile"])) {
    $no_files = count($_FILES["myfile"]['name']);
    for ($i = 0; $i < $no_files; $i++) { 
        if ($_FILES["myfile"]["error"][$i] > 0) {
            echo "Error: " . $_FILES["myfile"]["error"][$i] . "<br>";
        } else {
            /**
             *   Below code not required any more
             *   //$temp = explode(".", $_FILES["myfile"]["name"][$i]);
             *   //$extension = end($temp);
             **/
                move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $upload_dir . $_FILES["myfile"]["name"][$i]);
                echo "<br><font color='green'>".$_FILES["myfile"]["name"][$i] . " Uploaded Successfully.</font><br>";            
        }
    }
}

/*
// Need to follow conding standards
// Need to use object oriented concept
// Need to display proper error messages
 // Uploaded file name should be unique        
 // Add validation for upload spesific files like only images,pdf,word,etc
    use finfo class to check MIME Type
*/

?>        

