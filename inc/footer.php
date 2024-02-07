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


    setActive();
</script>