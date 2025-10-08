<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title><?php echo $settings_r['site_title'] ?> - About</title>
  
  <style>
    .box{
      border-top-color: #2ec1ac !important
    }
  </style>
</head>

<body class="color-bg">

  <?php require('inc/header.php'); ?>

  <!-- intro -->

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">About Us</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Αυτή είναι η εργασίας μας για το μάθημα: Τεχνολογία Λογισμικού. <br> 
      Η ιστοσελίδα είναι έχει ως θέμα: Διαχείριση κρατήσεων ξενοδοχείου <br>
    </p>
  </div>

  <!-- information -->

  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4">
        <h3 class="mb-3">Ομάδα Εργασίας</h3>
        <p>
        Τσομάκας Βασίλειος 20390247<br>
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4">
        <h3 class="mb-3">Υλοποίηση</h3>
        <p>
          PHP <br>
          HTML <br>
          CSS <br>
          JAVASCRIPT <br>
          SQL <br>
          Xampp <br>
          Apache Server
        </p>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images-about/hotel.svg" width="70px">
          <h4 class="mt-3">25+ ROOMS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images-about/rating.svg" width="70px">
          <h4 class="mt-3">350+ REVIEWS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images-about/customers.svg" width="70px">
          <h4 class="mt-3">800+ HAPPY CUSTOMERS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images-about/staff.svg" width="70px">
          <h4 class="mt-3">70+ STAFF</h4>
        </div>
      </div>
    </div>
  </div>
  
  

  <?php require('inc/footer.php'); ?>

</body>
</html>