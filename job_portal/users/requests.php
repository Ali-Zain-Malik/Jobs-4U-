<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/requests.css">
    <title>Requests</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div class="main-holder d-grid">
        <div class="container main-container">
            <p class="h5 pt-4 fw-bold text-center heading"></p>
            <table id="myTable" class="display text-center">
                <thead>
                    <tr>
                        <th class="text-center">Sr. No.</th>
                        <th class="text-center">Applicant</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="fw-semibold applicant">
                        <!-- <div class="container m-0 p-0 d-flex align-items-center justify-content-between" style="width:60%;"> -->
                            <div class="image-div">
                                <img src="assets/img/my_image.png" alt="">
                            </div>
                            <p class="name m-0 ">Muhammad Ali Zain</p>
                        <!-- </div> -->
                        </td>
                        <td> 


                        <div class="action-div">

                            <div class="dropdown text-end">
                                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="assets/img/caret-down-fill.svg" alt="">
                                    <img src="assets/img/card-list.svg" alt="">
                                </a>

                                <ul class="dropdown-menu text-small">
                                    <li><a class="dropdown-item" href="#">Download</a></li>
                                </ul>
                            </div>

                        </div>

                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td class="fw-semibold applicant">
                        <!-- <div class="container m-0 p-0 d-flex align-items-center justify-content-between" style="width:60%;"> -->
                            <div class="image-div">
                                <img src="assets/img/my_image.png" alt="">
                            </div>
                            <p class="name m-0">Muhammad Jilani</p>
                        <!-- </div> -->
                        </td>
                        <td>

                            <div class="action-div">

                                <div class="dropdown text-end">
                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="assets/img/caret-down-fill.svg" alt="">
                                        <img src="assets/img/card-list.svg" alt="">
                                    </a>

                                    <ul class="dropdown-menu text-small">
                                        <li><a class="dropdown-item" href="#">Download</a></li>
                                    </ul>
                                </div>

                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">3</td>
                        <td class="fw-semibold applicant">
                            <!-- <div class="container m-0 p-0 d-flex align-items-center justify-content-between" style="width:60%;"> -->
                                <div class="image-div">
                                    <img src="assets/img/my_image.png" alt="">
                                </div>
                                <p class="name m-0">Muhammad Ali</p>
                            <!-- </div> -->
                            
                        </td>
                        <td>

                            <div class="action-div">

                                <div class="dropdown text-end">
                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="assets/img/caret-down-fill.svg" alt="">
                                        <img src="assets/img/card-list.svg" alt="">
                                    </a>

                                    <ul class="dropdown-menu text-small">
                                        <li><a class="dropdown-item" href="#">Download</a></li>
                                    </ul>
                                </div>

                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <!-- <div class="footer-div">
        <?php //include("footer.html"); ?>
    </div> -->
</body>

<script src="assets/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="assets/js/requests.js"></script>
</html>

<script>
    let table = new DataTable('#myTable');
</script>