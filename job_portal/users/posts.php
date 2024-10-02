<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <title>Posts</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        background-color: rgb(233, 234, 217);
    }

    .main-container {
        margin-top: 60px;
    }

    #myTable_wrapper {
        padding: 0 30px;
        padding-top: 20px;
        background-color: rgb(235, 235, 229);

    }

    .action-div {
        cursor: pointer;
    }


    .action::after
    {
        display: none;
    }
    
    .footer-div {
        background-color: rgb(235, 235, 229);
        margin-top: 100px;
    }

    @media screen and (max-width: 768px) {
        .main-container {

            margin: 60px 0;
            width: 100%;
            justify-self: center;
            max-width: 760px;
        }
    }

</style>

<body>
    <?php include("header.php"); ?>
    <div class="main-holder d-grid">
        <div class="container main-container">
            <p class="h4 pt-4 fw-bold text-center">My Posts</p>
            <table id="myTable" class="display text-center">
                <thead>
                    <tr>
                        <th class="text-center">Sr. No.</th>
                        <th class="text-center">Posts</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Applicants</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="fw-semibold">Senior Web Dev</td>
                        <td>Expired</td>
                        <td class="text-center">130</td>
                        <td class="d-flex justify-content-around action-btns" job-title="Senior Web Dev">
                            <div class="action-div">
 
                                <div class="dropdown text-end">
                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="assets/img/caret-down-fill.svg" alt="">
                                        <img src="assets/img/card-list.svg" alt="">
                                    </a>

                                    <ul class="dropdown-menu text-small">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="requests.php">Applicants</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td class="fw-semibold">Senior Android Dev</td>
                        <td>Draft</td>
                        <td class="text-center">120</td>
                        <td class="d-flex justify-content-around action-btns" job-title="Senior Android Dev">
                            <div class="action-div">

                                <div class="dropdown text-end">
                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="assets/img/caret-down-fill.svg" alt="">
                                        <img src="assets/img/card-list.svg" alt="">
                                    </a>

                                    <ul class="dropdown-menu text-small">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="requests.php">Applicants</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>

                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td class="text-center">3</td>
                        <td class="fw-semibold">React.Js</td>
                        <td>Active</td>
                        <td class="text-center">33</td>
                        <td class="d-flex justify-content-around action-btns" job-title="React.Js">
                            <div class="action-div">

                                <div class="dropdown text-end">
                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="assets/img/caret-down-fill.svg" alt="">
                                        <img src="assets/img/card-list.svg" alt="">
                                    </a>

                                    <ul class="dropdown-menu text-small">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="requests.php">Applicants</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer-div">
        <?php include("footer.html"); ?>
    </div>
</body>
<script src="assets/js/jquery.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<script src="assets/js/posts.js"></script>
</html>

<script>
    let table = new DataTable('#myTable');
</script>