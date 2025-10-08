<?php 

    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - New Bookings</title>
    <?php require('inc/links.php'); ?>
    <style>
        .custom-alert{
            position: fixed;
            top: 80px;
            right: 25px;
        }

        /*custom scrollbar*/
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }
        /* track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }
        /* handle hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="color-bg">

    <?php require('inc/header.php') ?>

    <!-- main table -->

    <div class="container-fluid" id="main-container">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">New Bookings</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Search">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover border" style="min-width: 1200px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">User Details</th>
                                        <th scope="col">Room Details</th>
                                        <th scope="col">Booking Details</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Assign room number modal -->

    <div class="modal fade" id="assign-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="assign_room_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Room Number</label>
                            <input type="text" name="room_no" id="feature_name_inp" class="form-control shadow-none" required>
                        </div>
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                            Note: Assign Room Number only when the customer has arrived at the hotel.
                        </span>
                        <input type="hidden" name="booking_id">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Assign</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

 



    <?php require('inc/scripts.php') ?>

    <script src="scripts/new_bookings.js"></script>

</body>
</html>