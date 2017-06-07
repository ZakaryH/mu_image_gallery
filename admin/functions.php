<?php 

function createThumbnail($filepath, $thumbpath, $thumbnail_width, $thumbnail_height) {

    list($original_width, $original_height, $original_type) = getimagesize($filepath);

    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }

    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);

    if ($original_type === 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    } else if ($original_type === 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    } else if ($original_type === 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    } else {
        return false;
    }

    $old_image = $imgcreatefrom($filepath);
    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height); // creates new image, but with a black background



    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
    $imgt($new_image, $thumbpath);

    return file_exists($thumbpath);
}

function createThumb ($file, $dimensions = "150") {
    // thumbnail making logic
    // $file = $_FILES['image_file']['tmp_name'];
    $folder = "../uploads/thumbs" . $dimensions . "/";
     $newFileName = $folder . basename( $_FILES['image_file']['name']);
     $newWidth = $dimensions;
     
     list($width, $height) = getimagesize($file);
     $imgRatio = $width/$height;
     // $newHeight = $newWidth/$imgRatio;
     $newHeight = $dimensions;
     
     
     if($_FILES['image_file']['type'] =="image/jpeg" || $_FILES['image_file']['type'] == "image/jpg"){
     
         $thumb = imagecreatetruecolor($newWidth, $newHeight);
         $source = imagecreatefromjpeg($file);
         imagecopyresampled($thumb,$source, 0,0,0,0, $newWidth, $newHeight,$width, $height); 
         imagejpeg($thumb,$newFileName,100);
         
     }elseif($_FILES['image_file']['type'] == "image/png"){
     
         $thumb = imagecreatetruecolor($newWidth, $newHeight);
         $source = imagecreatefrompng($file);
         imagecopyresampled($thumb,$source, 0,0,0,0, $newWidth, $newHeight,$width, $height); 
         imagepng($thumb,$newFileName,9);
         
     }elseif($_FILES['image_file']['type'] == "image/gif"){ 
     
         $thumb = imagecreatetruecolor($newWidth, $newHeight);
         $source = imagecreatefromgif($file);
         imagecopyresampled($thumb,$source, 0,0,0,0, $newWidth, $newHeight,$width, $height); 
         imagegif($thumb,$newFileName);
     }

}

 ?>