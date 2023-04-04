<?php
if(isset($_FILES['fileToUpload'])) {
  $file_name = $_FILES['fileToUpload']['name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_tmp = $_FILES['fileToUpload']['tmp_name'];
  $file_type = $_FILES['fileToUpload']['type'];
  $file_ext = strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
  if($file_size > 209715200) echo 'File size must be less than 200 MB';
  $file_path = "/var/www/html/file/".$file_name;
  if (file_exists($file_path)) {
      echo "file existed";
  } else {
    move_uploaded_file($file_tmp,"/var/www/html/file/".$file_name);
    echo '<script>alert("succeedfully"); window.location.href = "upload.php";</script>';
  }
  


}
?>

<a href="Sticky.php">to Sticky</a>
<form action="" method="POST" enctype="multipart/form-data">
  <input type="file" name="fileToUpload">
  <input type="submit" value="Upload">
</form>
<?php
  $dir = "/var/www/html/file";
  $files = scandir($dir);

  echo "<ul>";
  foreach($files as $file) {
    if ($file != "." && $file != "..") {
	  echo "<li><a href=\"file\\$file\">$file</a></li>";
    }
  }
  echo "</ul>";
?>
