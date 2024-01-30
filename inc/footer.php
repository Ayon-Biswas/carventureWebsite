<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-6 p-4">
            <h3 class="h-font fw-bold fs-3 ">Car Venture</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Rem dolor quod tempora autem laboriosam adipisci modi recusandae hic alias,
                quaerat distinctio, ex molestiae consequatur non sequi, harum aliquam consectetur voluptatibus.
            </p>
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
    setActive();
</script>