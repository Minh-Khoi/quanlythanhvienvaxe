<?php
session_start();

require_once dirname(__FILE__, 2) . "/models/action/action.php";

$action = new action();

$id_thanhvien = $_POST["id_thanhvien"];

$target_dir =  '../media' . '/';
$target_file = $target_dir . time() .  basename($_FILES["files"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// check number of images of a member 
// code ...

// Check if image file is a actual image or fake image
if (isset($_POST["id_thanhvien"])) {
  $check = getimagesize($_FILES["files"]["tmp_name"]);
  if ($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["files"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
    // echo "The file " . basename($_FILES["files"]["name"]) . " has been uploaded.";
    // do nothing()
  } else {
    echo "Sorry, there was an error uploading your file.";
    // var_dump($id_thanhvien);
    echo ($target_file);
  }
}

// action save link file to database
$action->save_link_image($id_thanhvien, $target_file);