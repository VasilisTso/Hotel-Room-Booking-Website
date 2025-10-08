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
    <title>Admin Panel - Booking Records</title>
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
                <h3 class="mb-4">Booking Records</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" id="search_input" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Search">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border" style="min-width: 1200px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">User Details</th>
                                        <th scope="col">Room Details</th>
                                        <th scope="col">Booking Details</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                </tbody>
                            </table>
                        </div>

                        <!-- pagination -->
                        <nav>
                            <ul class="pagination mt-3" id="table-pagination">
                            </ul>
                        </nav>

                    </div>
                </div>

            </div>
        </div>
    </div>

 



    <?php require('inc/scripts.php') ?>

    <script src="scripts/booking_records.js"></script>

</body>
</html>