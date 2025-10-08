<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <?php require('inc/links.php') ?>
  <title><?php echo $settings_r['site_title'] ?> - Home</title>

  <style>
    :root{
      --teal: #2ec1ac;
      --teal_hover: #279e8c;
    }


    .color-bg{
      background-color: rgb(180, 180, 180);
    }

    .checkavail{
      background-color: white;
      box-shadow: 2px 2px 2px rgb(173, 173, 173);
      padding: 4;
      border-radius: 5px;
    }

    .custom-bg{
      background-color: var(--teal);
      border: 1px solid var(--teal);
    }

    .custom-bg:hover{
      background-color: var(--teal_hover);
      border-color: var(--teal_hover);
    }

    label.checkavail{
      font-weight: 500;
    }

    .availability-form{
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width: 575px){
      .availability-form{
        margin-top: 0px;
        padding: 0 35px;
        position: relative;
      }
    }

    .custom-alert{
      position: fixed;
      top: 80px;
      right: 25px;
      z-index: 111;
    }
  </style>
</head>

<body class="color-bg">

  <?php require('inc/header.php'); ?>

  <!-- Carousel -->

  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="images-carousel/11.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="images-carousel/22.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="images-carousel/33.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="images-carousel/44.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="images-carousel/55.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="images-carousel/66.png" class="w-100 d-block"/>
        </div>
      </div>
    </div>
  </div>

  <!-- Check availability -->

  <div class="container availability-form">
    <div class="container checkavail">
      <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
          <h5 class="mb-4">Check Booking Availability</h5>
          <form action="rooms.php">
            <div class="row align-items-end mb-3">
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500;">Check-in</label>
                <input type="date" class="form-control shadow-none" name="checkin" required>
              </div>
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500;">Check-out</label>
                <input type="date" class="form-control shadow-none" name="checkout" required>
              </div>
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500;">Adult</label>
                <select class="form-select shadow-none" name="adult">
                  <?php 
                    $guests_q = mysqli_query($con,"SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children`
                      FROM `rooms` WHERE `status`=1 AND `removed`=0");

                    $guests_res = mysqli_fetch_assoc($guests_q);

                    for($i=1 ; $i <= $guests_res['max_adult'] ; $i++){
                      echo"<option value='$i'>$i</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-lg-2 mb-3">
                <label class="form-label" style="font-weight: 500;">Children</label>
                <select class="form-select shadow-none" name="children">
                    <?php 
                      for($i=1 ; $i <= $guests_res['max_children'] ; $i++){
                        echo"<option value='$i'>$i</option>";
                      }
                    ?>
                </select>
              </div>
              <input type="hidden" name="check_availability">
              <div class="col-lg-1 mb-lg-3 mt-2">
                <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Rooms -->

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">ROOMS FOR RENT</h2>

  <div class="container">
    <div class="row align-items-center">

      <?php 
        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

        while($room_data = mysqli_fetch_assoc($room_res))
        {
          //get features of room
          $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
            INNER JOIN `room_features` rfea ON f.id = rfea.features_id
            WHERE rfea.room_id = '$room_data[id]'");

          $features_data = "";
          while($fea_row = mysqli_fetch_assoc($fea_q)){
            $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              $fea_row[name]
            </span>";
          }

          //get facilities of room
          $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
            INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
            WHERE rfac.room_id = '$room_data[id]'");

          $facilities_data = "";
          while($fac_row = mysqli_fetch_assoc($fac_q)){
            $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              $fac_row[name]
            </span>";
          }

          //get room thumbnail image
          $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
          $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
            WHERE `room_id`='$room_data[id]' 
            AND `thumb`='1'");
          
          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
          }

          $book_btn = "";

          if(!$settings_r['shutdown']){
            $login = 0;
            if(isset($_SESSION['login']) && $_SESSION['login']==true){
              $login = 1;
            }

            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
          }
          
          //room rating from rating_review db
          $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
            WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";
          
          $rating_res = mysqli_query($con,$rating_q);
          $rating_fetch = mysqli_fetch_assoc($rating_res);

          $rating_data = "";

          if($rating_fetch['avg_rating']!=NULL){
            $rating_data = "<div class='rating mb-4'>
                <h6 class='mb-1'>Rating</h6>
                <span class='badge rounded-pill bg-light'>
            ";

            for($i=0 ; $i < $rating_fetch['avg_rating'] ; $i++){
              $rating_data .=" <i class='bi bi-star-fill text-warning'></i> ";
            }

            $rating_data .="</span>
              </div>
            ";
          }


          // print room card
          echo<<<data
            <div class="col-lg-4 col-md-6 my-3">
              <div class="card border-0 shadow" style="max-width: 350px;">
                <img src="$room_thumb" class="card-img-top">
                <div class="card-body">
                  <h5>$room_data[name]</h5>
                  <h6 class="mb-4">€$room_data[price] / night</h6>
                  <div class="features mb-3">
                    <h6 class="mb-1">Features</h6>
                    $features_data
                  </div>
                  <div class="facilities mb-3">
                    <h6 class="mb-1">Facilities</h6>
                    $facilities_data
                  </div>
                  $rating_data
                  <div class="d-flex justify-content-evenly mb-2">
                    $book_btn
                    <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                  </div>
                </div>
              </div>
            </div>
          data;
        }
      ?>

      <div class="col-lg-12 text-center mt-5">
        <a href="rooms.php" class="btn btn-outline-dark shadow-none me-lg-3 me-2">More Rooms</a>
      </div>
      
    </div>
  </div>

  <!-- Facilities -->

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">FEATURES & FACILITIES</h2>

  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">

      <?php 
        $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
        $path = FEATURES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
          echo<<<data
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
              <img src="$path$row[icon]" width="60px">
              <h5 class="mt-3">$row[name]</h5>
            </div>
          data;
        }
      ?>

      <div class="col-lg-12 text-center mt-5">
        <a href="facilities.php" class="btn btn-outline-dark shadow-none me-lg-3 me-2">More Facilities</a>
      </div>
    </div>
  </div>

  <!-- Reach Us -->

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 rounded">
        <h5>Πανεπιστημιούπολη Άλσους Αιγάλεω</h5>
          <a href="Address Αγίου Σπυρίδωνος, Αιγάλεω 12243" class="d-inline-block mb-2 text-decoration-none text-dark">Αγίου Σπυρίδωνος, Αιγάλεω 12243</a>
        <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="p-4 rounded mb-4">
          <h5>Call us</h5>
          <a href="Phone: +<?php echo $contact_r['pn'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn'] ?>
          </a>
        </div>
        <div class="p-4 rounded mb-4">
          <h5>Follow us</h5>
          <?php 
            if($contact_r['tw']!=''){
              echo<<<data
                <a href="$contact_r[tw]" class="d-inline-block mb-3" target="_blank">
                  <span class="badge text-dark fs-6 p-2">
                    <i class="bi bi-twitter-x"></i> Twitter-X
                  </span>
                </a>
                <br>
              data;
            }
          ?>
          
          <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-3" target="_blank">
            <span class="badge text-dark fs-6 p-2">
              <i class="bi bi-instagram"></i> Instagram
            </span>
          </a>
          <br>
          <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block" target="_blank">
            <span class="badge text-dark fs-6 p-2">
              <i class="bi bi-facebook"></i> Facebook
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- popup password reset when clicking recovery link sent to email -->

  <div class="modal fade" id="recoverymodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="recovery-form">
          <div class="modal-header">
            <h5 class="modal-title">
              <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
            </h5>
          </div>
          <div class="modal-body">
            <div class="mb-4">
              <label class="form-label">New Password</label>
              <input type="password" name="pass" class="form-control shadow-none">
              <input type="hidden" name="email">
              <input type="hidden" name="token">
            </div>
            <div class="mb-2 text-end">
              <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-dark shadow-none">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>





  <?php require('inc/footer.php'); ?>

  <?php

    if(isset($_GET['account_recovery']))
    {
      $data = filteration($_GET);

      $t_date = date("Y-m-d");

      $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
        [$data['email'],$data['token'],$t_date],'sss');

      if(mysqli_num_rows($query)==1){
        echo<<<showmodal
          <script>
            var myModal = document.getElementById('recoverymodal');

            myModal.querySelector("input[name='email']").value = '$data[email]';
            myModal.querySelector("input[name='token']").value = '$data[token]';

            var modal = bootstrap.Modal.getOrCreateInstance(myModal);
            modal.show();
          </script>
        showmodal;
      }
      else{
        alert("error","Invalid or Expired link.");
      }
    }

  ?>

  <script>
    //recover account
    let recovery_form = document.getElementById('recovery-form');

    recovery_form.addEventListener('submit', function(e){
        e.preventDefault();

        let data = new FormData();

        data.append('email',recovery_form.elements['email'].value);
        data.append('token',recovery_form.elements['token'].value);
        data.append('pass',recovery_form.elements['pass'].value);
        data.append('recover_user','');

        var myModal = document.getElementById('recoverymodal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/login_register.php",true);

        xhr.onload = function(){
            if(this.responseText == 'failed'){
                alert('error',"Account reset failed.");
            }
            else{
                alert('success',"Account reset successfully.");
                recovery_form.reset();
            }
        }

        xhr.send(data);
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="index.js"></script>
</body>
</html>