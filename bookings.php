<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title><?php echo $settings_r['site_title'] ?> - BOOKINGS</title>
  
  <style>
  </style>
</head>

<body class="color-bg">

  <?php 
  
    require('inc/header.php');

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('index.php');
    }
    
  ?>

  <div class="container">
    <div class="row">

      <!-- intro -->
      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">Bookings</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
        </div>
      </div>

      <?php

        $query = "SELECT bo.*, bd.* FROM `booking_order` bo
          INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
          WHERE ((bo.booking_status='booked')
          OR (bo.booking_status='cancelled')
          OR (bo.booking_status='payment failed'))
          AND (bo.user_id=?) 
          ORDER BY bo.booking_id DESC";
        
        $result = select($query,[$_SESSION['uId']],'i');

        while($data = mysqli_fetch_assoc($result)){
          $date = date("d-m-Y",strtotime($data['datentime']));
          $checkin = date("d-m-Y",strtotime($data['check_in']));
          $checkout = date("d-m-Y",strtotime($data['check_out']));

          $status_bg = "";
          $btn = "";

          if($data['booking_status']=='booked'){
            $status_bg = "bg-success";

            if($data['arrival']==1){
              $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='mt-2 btn btn-sm btn-dark shadow-none'>
                  Download PDF
                </a>
              ";
              if($data['rate_review']==0){
                $btn.="
                  <button  type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewmodal' class='mt-2 btn btn-sm btn-dark shadow-none ms-2'>
                    Rate & Review
                  </button>
                ";
              }
            }
            else{
              $btn = "<button onclick='cancel_booking($data[booking_id])' type='button' class='mt-2 btn btn-sm btn-danger shadow-none'>
                  Cancel
                </button>
              ";
            }
          }
          else if($data['booking_status']=='cancelled'){
            $status_bg = "bg-danger";

            if($data['refund']==0){
              $btn = "<span class='badge bg-primary'>
                  Refund in process.
                </span>
              ";
            }
            else{
              $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='mt-2 btn btn-sm btn-dark shadow-none'>Download PDF</a>";
            }
          }
          else{
            $status_bg = "bg-warning";
            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='mt-2 btn btn-sm btn-dark shadow-none'>Download PDF</a>";
          }

          echo<<<bookings
            <div class='col-md-4 px-4 mb-4'>
              <div class='bg-white p-3 rounded shadow-sm'>
                <h5 class='fw-bold'>$data[room_name]</h5>
                <p>€$data[price] / night</p>
                <p>
                  <b>Check-in: </b> $checkin <br>
                  <b>Check-out: </b> $checkout
                </p>
                <p>
                  <b>Amount: </b> €$data[price] <br>
                  <b>Check-out: </b> $data[order_id]
                  <b>Date: </b> $date <br>
                </p>
                <p>
                  <span class='badge $status_bg'>$data[booking_status]</span>
                </p>
                $btn
              </div>
            </div>
          bookings;
        }

      ?>

    </div>
  </div>
  


  <!-- rate and review popup -->
  <div class="modal fade" id="reviewmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="review-form">
          <div class="modal-header">
            <h5 class="modal-title">
              <i class="bi bi-chat-left-text-fill fs-3 me-2"></i> Rate & Review
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Rating</label>
              <select class="form-select shadow-none" name="rating">
                <option value="5">Excellent</option>
                <option value="4">Very Good</option>
                <option value="3">Good</option>
                <option value="2">Bad</option>
                <option value="1">Very Bad</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Review</label>
              <textarea name="review" rows="4" required class="form-control shadow-none"></textarea>
            </div>
            <input type="hidden" name="booking_id">
            <input type="hidden" name="room_id">
            <div class="text-end">
              <button type="submit" class="btn btn-dark shadow-none">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <?php 

    if(isset($_GET['cancel_status'])){
      alert('success','Booking Cancelled.');
    }
    else if(isset($_GET['review_status'])){
      alert('success','Thank you for your feedback.');
    }

  ?>

  <?php require('inc/footer.php'); ?>

  <script>

    function cancel_booking(id){
      if(confirm('Are you sure you want to cancel this booking?')){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/cancel_booking.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
          if(this.responseText==1){
            window.location.href='bookings.php?cancel_status=true';
          }
          else{
            alert('error','Cancellation failed.');  
          }
        }   

        xhr.send('cancel_booking&id='+id);
      }
    }

    let review_form = document.getElementById('review-form');

    function review_room(bid,rid)
    {
      review_form.elements['booking_id'].value = bid;
      review_form.elements['room_id'].value = rid;
    }

    review_form.addEventListener('submit', function(e){
      e.preventDefault();

      let data = new FormData();

      data.append('rating',review_form.elements['rating'].value);
      data.append('review',review_form.elements['review'].value);
      data.append('booking_id',review_form.elements['booking_id'].value);
      data.append('room_id',review_form.elements['room_id'].value);
      data.append('review_form','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/review_room.php",true);

      xhr.onload = function(){
        if(this.responseText == 1){
          window.location.href = 'bookings.php?review_status=true';
        }
        else{
          var myModal = document.getElementById('reviewmodal');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          alert('error',"Rating & Review failed.");
        }
      }  

      xhr.send(data);
    })

  </script>

</body>
</html>