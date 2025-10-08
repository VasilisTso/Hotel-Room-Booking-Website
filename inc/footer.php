<!-- Footer -->

<div class="container-fluid bg-dark text-white mt-5 p-3 mb-0">
  <div class="row">
    <div class="col-lg-4 p4 mb-3">
      <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
      <p>
        <?php echo $settings_r['site_about'] ?>
      </p>
    </div>
    <div class="col-lg-4 p4 mb-3">
      <h5 class="mb-3">Links</h5>
      <a href="index.php" class="d-inline-block mb-2 text-white text-decoration-none">Home</a> <br>
      <a href="rooms.php" class="d-inline-block mb-2 text-white text-decoration-none">Rooms</a> <br>
      <a href="facilities.php" class="d-inline-block mb-2 text-white text-decoration-none">Facilities</a> <br>  
      <a href="contact.php" class="d-inline-block mb-2 text-white text-decoration-none">Contact us</a> <br>
      <a href="about.php" class="d-inline-block mb-2 text-white text-decoration-none">About</a>
    </div>
    <div class="col-lg-4 p4">
      <h5 class="mb-3">Follow us</h5>
      <?php 
            if($contact_r['tw']!=''){
              echo<<<data
                <a href="$contact_r[tw]" class="d-inline-block text-white text-decoration-none mb-2" target="_blank">
                  <i class="bi bi-twitter"></i> Twitter
                </a>
                <br>
              data;
            }
        ?>
        <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-white text-decoration-none mb-2" target="_blank">
            <i class="bi bi-instagram"></i> Instagram
        </a>
        <br>
        <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-white text-decoration-none" target="_blank">
            <i class="bi bi-facebook"></i> Facebook
        </a>
    </div>
  </div>
</div>

<!-- link bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<style>
  .custom-alert{
    position: fixed;
    top: 80px;
    right: 25px;
    z-index: 111;
  }
</style>

<script>

  function alert(type,msg,position='body')
  {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    if(position=='body'){
        document.body.append(element);
        element.classList.add('custom-alert');
    }
    else{
        document.getElementById(position).appendChild(element);
    }

    setTimeout(remAlert, 4000);
  }

  function remAlert(){
    document.getElementsByClassName('alert')[0].remove();
  }

  function setActive()
  {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0 ; i<a_tags.length ; i++){
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name) >= 0){
        a_tags[i].classList.add('active');
      }
    }
  }

  let register_form = document.getElementById('register-form');

  register_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phonenum',register_form.elements['phonenum'].value);
    data.append('dob',register_form.elements['dob'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('cpass',register_form.elements['cpass'].value);
    data.append('profile',register_form.elements['profile'].files[0]);
    data.append('register','');

    var myModal = document.getElementById('registermodal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'pass_mismatch'){
        alert('error',"Pass Mismatch.");
      }
      else if(this.responseText == 'email_already'){
        alert('error',"Email is already registered.");
      }
      else if(this.responseText == 'phone_already'){
        alert('error',"Phone number is already registered.");
      }
      else if(this.responseText == 'inv_img'){
        alert('error',"Only JPG, WEBP, PNG images.");
      }
      else if(this.responseText == 'upd_failed'){
        alert('error',"Image upload failed.");
      }
      else if(this.responseText == 'mail_failed'){
        alert('error',"Cannot send confirmation email. Server down.");
      }
      else if(this.responseText == 'ins_failed'){
        alert('error',"Registration Failed.");
      }
      else{
        alert('success',"Registration successfull. Confirmation link sent to email.");
        register_form.reset();
      }
    }

    xhr.send(data);
  });

  let login_form = document.getElementById('login-form');

  login_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('email_mob',login_form.elements['email_mob'].value);
    data.append('pass',login_form.elements['pass'].value);
    data.append('login','');

    var myModal = document.getElementById('loginmodal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email_mob'){
        alert('error',"Invalid Email or Mobile number.");
      }
      else if(this.responseText == 'not_verified'){
        alert('error',"Email not verified.");
      }
      else if(this.responseText == 'inactive'){
        alert('error',"Account suspended.");
      }
      else if(this.responseText == 'invalid_pass'){
        alert('error',"Invalid Password.");
      }
      else{
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if(fileurl == 'room_details.php'){
          window.location = window.location.href;
        }
        else{
          window.location = window.location.pathname;
        }
      }
    }

    xhr.send(data);
  });

  let forgot_form = document.getElementById('forgot-form');

  forgot_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('email',forgot_form.elements['email'].value);
    data.append('forgot_pass','');

    var myModal = document.getElementById('forgotmodal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email'){
        alert('error',"Invalid Email.");
      }
      else if(this.responseText == 'not_verified'){
        alert('error',"Email not verified.");
      }
      else if(this.responseText == 'inactive'){
        alert('error',"Account suspended.");
      }
      else if(this.responseText == 'mail_failed'){
        alert('error',"Cannot sent email.");
      }
      else if(this.responseText == 'upd_failed'){
        alert('error',"Password reset failed.");
      }
      else{
        alert('success',"Reset link sent successfully.");
        forgot_form.reset();
      }
    }

    xhr.send(data);
  });

  function checkLoginToBook(status,room_id){
    if(status){
      window.location.href='confirm_booking.php?id='+room_id;
    }
    else{
      alert('error','Please login to book a room.');
    }
  }

  setActive();

</script>