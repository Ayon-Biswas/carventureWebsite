<?php

require ('../admin/inc/db_config.php');
require ('../admin/inc/essentials.php');
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

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? AND `phonenum`=? LIMIT 1",
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

?>