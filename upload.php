<?php

session_start();


$path = "panos"."/".$_SESSION["this_seesion_id"];


if(!is_dir($path)){     // is_dir()函数判断指定的文件夹是否存在
    mkdir("$path", 0777);         // mkdir()函数创建文件夹
  }


$target_dir = $path;

$target_file = $target_dir ."/". basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION); 



// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
$isCopied=false;
if (file_exists($target_file)) {
    rename($target_file, $target_dir ."/copy-". basename($_FILES["fileToUpload"]["name"]));
    $isCopied=true;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
&& $imageFileType != "GIF") {

    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        if($isCopied){
        $folder_name = "\"E:/xampp/htdocs/public/720cloud/".$target_dir ."/copy-". basename($_FILES["fileToUpload"]["name"])."\"";
        echo $folder_name;
        }
        else
        {

        $folder_name = "\"E:/xampp/htdocs/public/720cloud/".$target_file ."\"";
        echo $folder_name;

        }
    } else {    
        echo "Sorry, there was an error uploading your file."; 

    }
}   
?>

