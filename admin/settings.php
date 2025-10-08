<?php 

    require('inc/essentials.php');
    adminLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require('inc/links.php'); ?>
    <style>

    </style>
</head>

<body class="color-bg">

    <?php require('inc/header.php') ?>

    <!-- main container -->

    <div class="container-fluid" id="main-container">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Settings</h3>

                <!-- general settings -->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-settings">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>

                <!-- general settings modal -->

                <div class="modal fade" id="general-settings" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_settings_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About us</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="document.getElementById('site_title_inp').value = general_data.site_title; document.getElementById('site_about_inp').value = general_data.site_about;" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shutdown settings -->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Settings</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                    <label class="form-check-label" for="shutdown-toggle">OFF / ON</label>
                                </form>
                            </div>
                        </div>
                        <p class="card-text">
                            No customers will be allowed to book a room when
                            shutdown mode is turned on.
                        </p>
                    </div>
                </div>

                <!-- Contact details settings -->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contact-settings">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p> 
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Maps</h6>
                                    <p class="card-text" id="gmap"></p> 
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Number</h6>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="pn"></span>
                                    </p> 
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-envelope"></i>
                                        <span id="email"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-twitter-x"></i>
                                        <span id="tw"></span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-instagram"></i>
                                        <span id="insta"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-facebook"></i>
                                        <span id="fb"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy" src="" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact details settings modal -->

                <div class="modal fade" id="contact-settings" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="contact_settings_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" name="address" id="address_inp" class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Map Link</label>
                                                    <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Phone Number (with country code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-telephone-fill"></i> 
                                                        </span>
                                                        <input type="number" name="pn" id="pn_inp" class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">E-mail</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-envelope"></i>
                                                        </span>
                                                        <input type="text" name="email" id="email_inp" class="form-control shadow-none" required>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-twitter-x"></i>
                                                        </span>
                                                        <input type="text" name="tw" id="tw_inp" class="form-control shadow-none">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-instagram"></i>
                                                        </span>
                                                        <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-facebook"></i>
                                                        </span>
                                                        <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Iframe Src</label>
                                                    <input type="text" name="iframe" id="iframe_inp" class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="contact_inp(contact_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    



    <?php require('inc/scripts.php') ?>
    <script src="scripts/settings.js"></script>

</body>
</html>