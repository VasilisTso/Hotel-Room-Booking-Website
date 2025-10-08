<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title><?php echo $settings_r['site_title'] ?> - PROFILE</title>
  
  <style>
  </style>
</head>

<body class="color-bg">

  <?php 
  
    require('inc/header.php');

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('index.php');
    }

    $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');

    if(mysqli_num_rows($u_exist)==0){
      redirect('index.php');
    }
    $u_fetch = mysqli_fetch_assoc($u_exist);
    
  ?>

  <div class="container">
    <div class="row">

      <!-- intro -->
      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">My Profile</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
        </div>
      </div>

      <!-- basic info -->
      <div class="col-12 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="info-form">
            <h5 class="mb-3 fw-bold">Basic Information</h5>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Phone Number</label>
                <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Date of Birth</label>
                <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
              </div>
            </div>
            <button type="submit" class="btn btn-dark shadow-none">Save changes</button>
          </form>
        </div>
      </div>

      <!-- profile picture change -->
      <div class="col-md-4 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="profile-form">
            <h5 class="mb-4 fw-bold">Picture</h5>
            <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile'] ?>" class="rounded-circle img-fluid">
            <div class="mt-2 row p-2">
              <label class="form-label">New Picture</label>
              <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="mb-4 form-control shadow-none" required>
            </div>
            <button type="submit" class="btn btn-dark shadow-none">Save changes</button>
          </form>
        </div>
      </div>

      <!-- password change -->
      <div class="col-md-8 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="pass-form">
            <h5 class="mb-4 fw-bold">Change Password</h5>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">New Password</label>
                <input name="new_pass" type="password" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Confirm New Password</label>
                <input name="confirm_pass" type="password" class="form-control shadow-none" required>
              </div>
            </div>
            <button type="submit" class="btn btn-dark shadow-none">Save changes</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  





  <?php require('inc/footer.php'); ?>

  <script>

    let info_form = document.getElementById('info-form');

    info_form.addEventListener('submit', function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('name',info_form.elements['name'].value);
      data.append('phonenum',info_form.elements['phonenum'].value);
      data.append('dob',info_form.elements['dob'].value);
      data.append('info_form','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function(){
        if(this.responseText == 'phone_already'){
          alert('error',"Phone number is already registered.");
        }
        else if(this.responseText == 0){
          alert('error',"No changes made.");
        }
        else{
          alert('success',"Changes saved.");
        }
      }   

      xhr.send(data);
    });


    let profile_form = document.getElementById('profile-form');

    profile_form.addEventListener('submit', function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('profile',profile_form.elements['profile'].files[0]);
      data.append('profile_form','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function(){
        if(this.responseText == 'inv_img'){
          alert('error',"Only JPG, WEBP, PNG images.");
        }
        else if(this.responseText == 'upd_failed'){
          alert('error',"Image upload failed.");
        }
        else if(this.responseText == 0){
          alert('error',"Change failed.");
        }
        else{
          window.location.href = window.location.pathname;
        }
      }   

      xhr.send(data);
    });


    let pass_form = document.getElementById('pass-form');

    pass_form.addEventListener('submit', function(e){
      e.preventDefault();

      let new_pass = pass_form.elements['new_pass'].value;
      let confirm_pass = pass_form.elements['confirm_pass'].value;

      if(new_pass != confirm_pass){
        alert('error','Password does not match.')
        return false;
      }

      let data = new FormData();
      data.append('new_pass',new_pass);
      data.append('confirm_pass',confirm_pass);
      data.append('pass_form','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function(){
        if(this.responseText == 'mismatch'){
          alert('error',"Password does not match.");
        }
        else if(this.responseText == 0){
          alert('error',"Change failed.");
        }
        else{
          alert('success',"Change successfull.");
          pass_form.reset();
        }
      }   

      xhr.send(data);
    });

  </script>

</body>
</html>