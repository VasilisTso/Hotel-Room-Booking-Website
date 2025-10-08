<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title><?php echo $settings_r['site_title'] ?> - Facilities</title>
  
  <style>
    .pop:hover{
      border-top-color: #2ec1ac !important;
      transform: scale(1.03);
      transition: all 0.3s;
    }
  </style>
</head>

<body class="color-bg">

  <?php require('inc/header.php'); ?>

  <!-- intro -->

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">Our Features & Facilities</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Our accommodation facilities provide: <br> 1. Spa services(appointment only) <br> 
      2. A huge infinity pool for relaxing and sunbathing <br> 3. A gym equipped with the 
      latest equipment ready for all exercises <br> 4. A theater room with a 80inc 
      screen for awesome movie nights <br><br> There are also some minor but 
      necessary services such as: <br> 1. Internet with 1 Gigabit speed <br> 2. The latest AC 
      units in each and every room for cool summers and warm winters <br>
      3. Every room has a smart TV for the perfect entertainment of our guests on 
      their leisure time.
    </p>
  </div>

  <!-- services -->

  <div class="container">
    <div class="row">

      <?php 
        $res = selectALL('facilities');
        $path = FEATURES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
          echo<<<data
            <div class="col-lg-4 col-md-6 mb-5 px-4">
              <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                  <img src="$path$row[icon]" width="40px">
                  <h5 class="m-0 ms-3">$row[name]</h5>
                </div>
                <p>
                  $row[descr]
                </p>
              </div>
            </div>
          data;
        }
      ?>

    </div>
  </div>
  



  <?php require('inc/footer.php'); ?>

</body>
</html>