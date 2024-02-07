<?php

//frontend purpose data
define('SITE_URL','http://127.0.0.1/carventureWebsite/');
define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
define('FACILITIES_IMG_PATH',SITE_URL.'images/facilities/');
define('CARS_IMG_PATH',SITE_URL.'images/cars/');


//backend upload process
define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/carventureWebsite/images/'); //returns absolute path of server and folder
define('CAROUSEL_FOLDER','carousel/');
define('FACILITIES_FOLDER','facilities/');
define('CARS_FOLDER','cars/');
define('USERS_FOLDER','users/');



function adminLogin()
{
    session_start();
    if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)) {
        echo "<script>window.location.href='index.php'</script>";
        exit;
    }
}

function redirect($url){
    echo "<script>window.location.href='$url'</script>";
    exit;
}

function alert($type,$msg){
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    // hero-doc printing method
    echo <<<alert
    <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
    <strong class="me-3">$msg</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    alert;
}

function uploadImage($image,$folder)
{
  $valid_mime = ['image/jpeg','image/png','image/webp'];
  $img_mime = $image['type'];

  if(!in_array($img_mime,$valid_mime)){
    return 'inv_img'; //invalid image mime or format
  }
  else if(($image['size']/(1024*1024))>2){ //1024*1024 from byte to kilo byte to mega byte
   return 'inv_size'; //invalid size greater than 2 mb
  }
  else{
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION); //extracting image extension without the "." like png,jpeg
    $rname ='IMG_'.random_int(11111,99999).".$ext";//random name for image. the dot outside double quote is for concatination dot inside is part of string.
    $img_path =UPLOAD_IMAGE_PATH.$folder.$rname;//absolute path,folder,random img name

    if(move_uploaded_file($image['tmp_name'], $img_path)){
        return $rname;
    }
    else{
        return 'upd_failed';
    }
  }
}

function deleteImage($image,$folder)
{ //unlink() function deletes a file
  if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
    return true;
  }
  else{
    return false;
  }  
}

function uploadSVGImage($image,$folder)
{
  $valid_mime = ['image/svg+xml']; //mime type(extension) is svg+xml
  $img_mime = $image['type'];

  if(!in_array($img_mime,$valid_mime)){
    return 'inv_img'; //invalid image mime or format
  }
  else if(($image['size']/(1024*1024))>1){ //1024*1024 from byte to kilo byte to mega byte
   return 'inv_size'; //invalid size greater than 1 mb
  }
  else{
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION); //extracting image extension without the "." like png,jpeg
    $rname ='IMG_'.random_int(11111,99999).".$ext";//random name for image. the dot outside double quote is for concatination dot inside is part of string.
    $img_path =UPLOAD_IMAGE_PATH.$folder.$rname;//absolute path,folder,random img name

    if(move_uploaded_file($image['tmp_name'], $img_path)){
        return $rname;
    }
    else{
        return 'upd_failed';
    }
  }
}

function uploadUserImage($image) //user won't have size constraint.uploaded image will be optimized by system to jpeg.
{
  $valid_mime = ['image/jpeg','image/png','image/webp'];
  $img_mime = $image['type'];

  if(!in_array($img_mime,$valid_mime)){
    return 'inv_img'; //invalid image mime or format
  }
  else{
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION); //extracting image extension without the "." like png,jpeg
    $rname ='IMG_'.random_int(11111,99999).".jpeg";//random name for image. the dot outside double quote is for concatination dot inside is part of compressing and converting image to jpeg.
    $img_path =UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;//absolute path,folder,random img name.

    //returns an image identifier representing the image obtained from the given filename.Create a new image from file or URL.Under GD(graphics) library.

    if($ext == 'png' || $ext == 'PNG')
    {
      $img = imagecreatefrompng($image['tmp_name']); //passing temporary path of the image. 
    }
    elseif($ext == 'webp' || $ext == 'WEBP')
    {
      $img = imagecreatefromwebp($image['tmp_name']);
    }
    else{
      $img = imagecreatefromjpeg($image['tmp_name']);
    }

    //imagejpeg outputs image to browser of file.uploaded image will be stored as jpeg.75 is quality,image will convert to 70% of original quality.
    if(imagejpeg($img,$img_path,75)){
        return $rname;
    }
    else{
        return 'upd_failed';
    }
  }
}

?>