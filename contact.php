<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title><?php echo $settings_r['site_title'] ?> - CONTACT US</title>
  
  <style>
    .custom-alert{
      position: fixed;
      top: 80px;
      right: 25px;
    }
  </style>
</head>

<body class="color-bg">

  <?php require('inc/header.php'); ?>

  <!-- intro -->

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">Contact Us</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Reach me at my academic email: <br><br>
      <a href="mailto: ice20390247@uniwa.gr" class="text-decoration-none text-dark">
        <i class="bi bi-envelope"></i> ice20390247@uniwa.gr
      </a> <br>
    </p>
  </div>

  <!-- information -->

  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4">
          <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <h5>Address</h5>
          <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark">
            <span class="badge text-dark fs-6 p-2">
              <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>
            </span>
          </a>
          <h5 class="mt-3">Call us</h5>
          <a href="Phone: +<?php echo $contact_r['pn'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <span class="badge text-dark fs-6 p-2">
              <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn'] ?>
            </span>
          </a>
          <h5 class="mt-4">Follow us</h5>
          <?php 
            if($contact_r['tw']!=''){
              echo<<<data
                <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2" target="_blank">
                  <i class="bi bi-twitter-x"></i>
                </a>
                <br>
              data;
            }
          ?>
          <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark fs-5 me-2" target="_blank">
            <i class="bi bi-instagram"></i>
          </a>
          <br>
          <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-5 me-2" target="_blank">
            <i class="bi bi-facebook"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4">
          <form method="POST">
            <h5>Send a message</h5>
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
              <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
            </div>
            <button type="submit" name="send" class="btn text-white custom-bg shadow-none mt-3">Send</button>
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
        alert('success','Mail sent.');
      }
      else{
        alert('error','Server down! Try again later.');
      }
    }

  ?>


  <?php require('inc/footer.php'); ?>

</body>
</html>