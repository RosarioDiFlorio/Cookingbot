<?php
   // Edit upload location here
   
   $name = $_POST['photo_id'];
   
   $destination_path = getcwd().DIRECTORY_SEPARATOR;

   $result = 0;
   
   $target_path = $destination_path . 'img/recipes/'.$name.'.jpg';

   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }
   
   echo '<script language="javascript">';
	echo 'alert("Upload successful")';
	echo '</script>';
    echo "<script>window.close();</script>";
?>