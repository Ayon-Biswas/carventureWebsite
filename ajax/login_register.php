<?php

require ('../admin/inc/db_config.php');
require ('../admin/inc/essentials.php');
date_default_timezone_set("Asia/Dhaka"); //php supported timezone under asia,dhaka the closest region to us.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($email,$token){
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'ayonshirsho@gmail.com';
        $mail->Password   = 'ehjducqqyyexafme';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
        $mail->Port       = 465;                                     
    
        $mail->setFrom('ayonshirsho@gmail.com', 'Ayon');
        $mail->addAddress($email);
    
        $mail->isHTML(true);
        $mail->Subject = 'Email verification from Ayon';
        $mail->Body    = "Thanks for registration!
        Click the link below to confirm the email address.
        <a href='".SITE_URL."email_confirm.php?email_confirmation&email=$email&token=$token"."'> Click Me </a>";
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function sendResetMail($email,$token){
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'ayonshirsho@gmail.com';
        $mail->Password   = 'ehjducqqyyexafme';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
        $mail->Port       = 465;                                     
    
        $mail->setFrom('ayonshirsho@gmail.com', 'Ayon');
        $mail->addAddress($email);
    
        $mail->isHTML(true);
        $mail->Subject = 'Account Reset Link';
        $mail->Body    = "Here is the link for resetting Password!
        Click the link below to reset the password.
        <a href='".SITE_URL."index.php?account_recovery&email=$email&token=$token"."'> Click Me </a>";
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['register']))
{
    $data = filteration($_POST);

    //match password and confirm password

    if($data['pass']!= $data['cpass'])
    {
        echo 'pass_mismatch';
        exit;
    }

    //check if user already exits

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    [$data['email'],$data['phonenum']],"ss");

    if(mysqli_num_rows($u_exist)!=0)
    {
      $u_exist_fetch = mysqli_fetch_assoc($u_exist);
      echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already'; //? is ternery operator
      exit;
    }

    //upload user image to server
    $img = uploadUserImage($_FILES['profile']);

    if($img == 'inv_img')
    {
        echo 'inv_img';
        exit;
    }
    else if($img == 'upd_failed'){
        echo 'upd_failed';
        exit;
    }

    //send confirmation link to user's email
    
     $token = bin2hex(random_bytes(16));
     if(!sendEmail($data['email'],$token)){
        echo 'mail_failed';
        exit;
     }
     
     //password encryption
     $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

     $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, 
     `profile`, `password`,`token`) VALUES (?,?,?,?,?,?,?,?,?)";
     $values = [$data['name'],$data['email'],$data['address'],$data['phonenum'],$data['pincode'],$data['dob'],$img,$enc_pass,$token];

     if(insert($query,$values,'sssssssss')){
        echo "success";
     }
     else{
        echo 'ins_failed';
     }
}


if(isset($_POST['login']))
{
    $data = filteration($_POST);

    //check if user already exits,verified and not blocked by admin

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    [$data['email_mob'],$data['email_mo']],"ss");

    if(mysqli_num_rows($u_exist)==0)
    {
      echo 'inv_email_mob';
    }
    else{
      $u_fetch = mysqli_fetch_assoc($u_exist);  

      if($u_fetch['is_verified']==0){
        echo 'not_verified';
      }
      else if($u_fetch['status']==0){
        echo 'inactive';
      }
      else{
        if(!password_verify($data['pass'],$u_fetch['password'])) //function verifies a password with a hash
        {
          echo 'invalid_pass';
        }
        else{
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['uId'] = $u_fetch['id'];
            $_SESSION['uName'] = $u_fetch['name'];
            $_SESSION['uPic'] = $u_fetch['profile'];
            $_SESSION['uPhone'] = $u_fetch['phonenum'];
            echo 1;
        }
      }
    }
}
   
if(isset($_POST['forgot_pass']))
{
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",[$data['email']],"s");

    if(mysqli_num_rows($u_exist)==0)
    {
      echo 'inv_email';
    }
    else{
       $u_fetch = mysqli_fetch_assoc($u_exist);  
      if($u_fetch['is_verified']==0){
        echo 'not_verified';
      }
      else if($u_fetch['status']==0){
        echo 'inactive';
      }
      else{
        //send reset link to email
        $token = bin2hex(random_bytes(16));

        if(!sendResetMail($data['email'],$token)){
            echo 'mail_failed';
        }
        else{
            $date = date("Y-m-d"); //in db date stored in year-month-day format

            $query = mysqli_query($con,"UPDATE `user_cred` SET `token`='$token',`t_expire`='$date'
             WHERE `id`='$u_fetch[id]'");

             if($query){
              echo 1;
             }
             else{
                echo 'upd_failed';
             }
        }
      }
    }
}     
    
if(isset($_POST['recover_user']))
{
    $data = filteration($_POST);

    $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

    $query = "UPDATE `user_cred` SET `password`=?,  `token`=?,`t_expire`=?
    WHERE `email`=? AND `token`=?";

    $values = [$enc_pass,null,null,$data['email'],$data['token']]; //once password updated afterwards clicking the link wont work as values are set to null.

    if(update($query,$values,'sssss'))
    {
      echo 1;
    }
    else{
      echo 'failed';
    }
}
?>