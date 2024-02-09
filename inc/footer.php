<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-6 p-4">
            <h3 class="h-font fw-bold fs-3 "><?php echo $settings_r['site_title']  ?></h3>
            <p><?php echo $settings_r['site_about']  ?></p>
        </div>
        <div class="col-lg-6 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="cars.php" class="d-inline-block mb-2 text-dark text-decoration-none">Car</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About Us</a><br>
        </div>

    </div>
</div>
<h6 class="text-center bg-dark text-white p-3 m-0">Designed and developed by Ayon & Boby</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

<script>

function alert(type,msg,position='body'){
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
     element.innerHTML = `
     <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
      <strong class="me-3">${msg}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    `;

    if(position=='body')
    {
     document.body.append(element);
    }
    else{
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert,3000); //3000 milisecond is 3 seconds
  }

function remAlert(){
    document.getElementsByClassName('alert')[0].remove();//any tag that has the class "alert" the 0th element will be removed.Alerts won't stack on each other
}


    function setActive()
    {
      let navbar = document.getElementById('nav-bar');
      let a_tags = navbar.getElementsByTagName('a');

      for(i=0;i<a_tags.length;i++){
        // document.location.href.split('/').pop()
        let file = a_tags[i].href.split('/').pop();
        let file_name = file.split('.')[0];

        if(document.location.href.indexOf(file_name) >= 0){
            a_tags[i].classList.add('active');
        }
      }
    }

    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('name',register_form.elements['name'].value);
      data.append('email',register_form.elements['email'].value);
      data.append('phonenum',register_form.elements['phonenum'].value);
      data.append('address',register_form.elements['address'].value);
      data.append('pincode',register_form.elements['pincode'].value);
      data.append('dob',register_form.elements['dob'].value);
      data.append('pass',register_form.elements['pass'].value);
      data.append('cpass',register_form.elements['cpass'].value);
      data.append('profile',register_form.elements['profile'].files[0]);
      data.append('register','');

      var myModal = document.getElementById('registerModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);
      xhr.onload = function () {
       if(this.responseText == 'pass_mismatch'){
        alert('error','password mismatch');
       }
       else if(this.responseText == 'email_already'){
        alert('error','email already taken');
       }
       else if(this.responseText == 'phone_already'){
        alert('error','phone number is already taken');
       }
       else if(this.responseText == 'inv_img'){
        alert('error','only JPG,WEBP,PNG allowed');
       }
       else if(this.responseText == 'upd_failed'){
        alert('error','image upload failed');
       }
       else if(this.responseText == 'mail_failed'){
        alert('error','cannot send confirmation email!server down');
       }
       else if(this.responseText == 'ins_failed'){
        alert('error','registration failed!server down');
       }
       else{
        alert('success','registration successful!confirmation link sent!');
        register_form.reset();
       }
    }

    xhr.send(data);
      
    });

    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('email_mob',login_form.elements['email_mob'].value);
      data.append('pass',login_form.elements['pass'].value);

      data.append('login','');

      var myModal = document.getElementById('loginModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload = function () {
       if(this.responseText == 'inv_email_mob'){
        alert('error','Invalid email or mobile number');
       }
       else if(this.responseText == 'not_verified'){
        alert('error','email not verified');
       }
       else if(this.responseText == 'inactive'){
        alert('error','account suspended! Please contact admin');
       }
       else if(this.responseText == 'invalid_pass'){
        alert('error','Incorrect password');
       }
       else{
        //split function will split data in form of array behalf of specific character like "/".pop function elements last index of array.
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if(fileurl == 'car_details.php'){
          window.location = window.location.href;
        }
        else{
         window.location = window.location.pathname;//in browser we want to reload the page the specific page from which user logs in.href can be maniputed but pathname shows absolute path of url. 
        }
        
       }
    }

    xhr.send(data);
      
    });

    let forget_form = document.getElementById('forgot-form');

    forget_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('email',forget_form.elements['email'].value);
      data.append('forgot_pass','');

      var myModal = document.getElementById('forgotModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload = function () {
       if(this.responseText == 'inv_email'){
        alert('error','Invalid email');
       }
       else if(this.responseText == 'not_verified'){
        alert('error','email not verified! Please contact admin');
       }
       else if(this.responseText == 'inactive'){
        alert('error','account suspended! Please contact admin');
       }
       else if(this.responseText == 'mail_failed'){
        alert('error','Cannot send email. Server down');
       }
       else if(this.responseText == 'upd_failed'){
        alert('error','password reset failed. Server down');
       }
       else{
        alert('success','reset link sent to email');
        forgot_form.reset();
       }
    }

    xhr.send(data);
      
    });

   function checkLoginToBook(status,car_id){
     if(status){
      window.location.href='confirm_booking.php?id='+car_id;
     }
     else{
      alert('error','Please login to book car');
     }
   }


    setActive();
</script>