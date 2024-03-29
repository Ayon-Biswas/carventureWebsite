<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require ('inc/links.php') ?>
  <title><?php echo $settings_r['site_title']?> - CONTACT</title>
</head>

<body class="bg-light">
  
<!-- Header -->
 <?php include "inc/header.php";?>
 
<!-- Contact -->
<div class="my-5 px-4">
  <h2 class="text-center fw-bold h-font">CONTACT US</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
  Contact us for seamless car rental services.<br>Our dedicated team is ready to assist you with any inquiries or reservations. Drive with confidence!
  </p>
</div>


<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 mb-5 px-4">

      <div class="bg-white rounded shadow p-4">
       <iframe class="w-100 rounded mb-4" height="320px" src="<?php echo $contact_r['iframe']?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       <h5>Address</h5>
       <a href="<?php echo $contact_r['gmap']?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
        <i class="bi bi-geo-alt-fill"></i><?php echo $contact_r['address']?>
       </a>

       <h5 class="mt-4">Call Us</h5>
        <a class="d-inline-block mb-2 text-decoration-none text-dark" href="tel: <?php echo $contact_r['pn1']?>">
        <i class="bi bi-telephone-fill"></i> <?php echo $contact_r['pn1']?>
        </a>
        <br>
        <a class="d-inline-block text-decoration-none text-dark" href="tel: <?php echo $contact_r['pn2']?>">
        <i class="bi bi-telephone-fill"></i> <?php echo $contact_r['pn2']?>
        </a>

        <h5 class="mt-4">Email</h5>
        <a href="mailto: <?php echo $contact_r['email']?>" class="d-inline-block text-decoration-none text-dark">
         <i class="bi bi-envelope-at"></i> <?php echo $contact_r['email']?>
        </a>

        <h5 class="mt-4">Follow Us</h5>
        <a class="d-inline-block  text-dark fs-6 me-2" href="<?php echo $contact_r['tw']?>" target="_blank">
         <i class="bi bi-twitter-x"></i>
        </a>
        
        <a class="d-inline-block text-dark fs-6 me-2" href="<?php echo $contact_r['fb']?>" target="_blank">
         <i class="bi bi-facebook"></i>
        </a>
        
        <a class="d-inline-block text-decoration-none text-dark text-dark fs-6" href="<?php echo $contact_r['git']?>" target="_blank">
         <i class="bi bi-github"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 px-4">
      <div class="bg-white rounded shadow p-4">
        <form method="POST">
          <h5>Send A Message</h5>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Name</label>
              <input name="name" required type="text" class="form-control shadow-none">
          </div>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Email</label>
              <input name="email" required type="email" class="form-control shadow-none">
          </div>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Subject</label>
              <input name="subject" required type="text" class="form-control shadow-none">
          </div>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Message</label>
              <textarea name="message" required class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
          </div>
          <button type="submit" name="send" class="btn btn-whit custom-bg mt-3 ">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php

if(isset($_POST['send']))
{
  $frm_data = filteration($_POST);

  $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
  $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];
  $res = insert($q,$values,'ssss');
  if($res==1){
    alert('success','Mail Sent!');
  }
  else{
    alert('error','Server Down! Try Again Later.');
  }
}
?>


<!-- Footer -->
<?php include "inc/footer.php";?>

</body>

</html>
