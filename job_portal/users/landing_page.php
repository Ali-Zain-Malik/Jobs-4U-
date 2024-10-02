<?php 

include("./config.php");

if(!isset($_SESSION["email"]))
{
    header("Location: ./sign_in.html");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/landing_page.css">
    <link rel="stylesheet" href="assets/css/common_attributes.css">
    <title>Landing Page</title>
</head>


<style>
    .select2-container--default .select2-selection--single
    {
        border: none;
        border-radius: 0;
    }
</style>


<body>

<?php include("header.php"); ?>

    <div class="hero-wrapper">
        <div class="over">
            <div class="tag-div">
                <p><strong>Every Success is a Dream First</strong></p>
            </div>
            <div class="search-div flex-column">
                <div class="search-box">
                    <input type="search" name="search-input" id="search-input" placeholder="Search For a Job">
                </div>

                <hr class="my-0">

                <div class="filters d-flex" style="height: 100%;">
                    <div class="location-div">
                            <div class="location-image">
                                <img class="location-icon" src="assets/img/location.svg" alt="">
                            </div>
                            <select name="city-selector" id="city-selector">
                                <option value="">All Locations</option>
                                <?php getCities(); ?>
                            </select>
                    </div>
                    <div class="d-flex align-items-center bg-white border-start border-dark ps-1" style="height: 100%; width: 40%;">
                        <i class="bx bxs-category fs-4"></i>
                        <select name="" id="category" class="" style="height: 100%;">
                            <option value="">All Categories</option>
                            <?php categoriesForFilter(); ?>
                        </select>
                    </div>
                    <div class="search-image search-btn">
                        <img class="search-icon" src="assets/img/search.svg" alt="">
                    </div>
                </div>
                
            </div>
        </div>
        <img class="hero-image" src="assets/img/hero.jpg" alt="Hero Image">
    </div>

    <div class="categories-div">
        <div class="container2">
            <div class="categories-heading-div">
                <div class="heading">
                    <h3 id="categories-heading">Browse Categories</h3>
                    <span>We Made Search Easier</span>
                </div>
                <a id="all-categories" href="./categories.php">
                    All Categories
                    <img src="assets/img/allCat.svg" alt="">
                </a>
            </div>

            <div class="cards-div">
                <div class="row1 justify-content-evenly flex-wrap-reverse text-capitalize">
                    <?php echo getCategories(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="featured-jobs-div">
        <div class="featured-jobs-outline">
        <div class="featured-heading-div">
            <h3 id="feature-heading">Featured Jobs</h3>
        </div>
        
        <div class="featured-content">
            <div class="container-fluid">
                <div class="row row-cols-lg-2 d-flex justify-content-lg-between featured-jobs align-items-center">
                    <?php getFeaturedJobs(); ?>
                </div>
            </div>
        </div>
    
        </div>
    </div>

    <div class="top-employers">
        <div class="container p-1">
            <p class="h4 text-center fw-bold text-dark pt-4">Top Employers</p>
            <p class="pb-4 text-center text-secondary-emphasis text-capitalize">watch out for your dream companies</p>
            <div class="row row-cols-lg-5  row-cols-sm-2 row-cols-1">
                <?php getTopEmployers(); ?>
            </div>
        </div>
    </div>



    <div class="reviews-div py-4">
        <p class="h3 text-center fw-bold text-capitalize text-dark mb-4">what our clients saying</p>
        <div id="carouselExampleInterval" class="carousel slide container" data-bs-ride="carousel">

            <div class="carousel-inner rounded review-carousel"> 

                <div class="carousel-item active px-4" data-bs-interval="3000">
                    <div class="card d-block w-100 review-card">
                        <div class="card-body">
                            <h5 class="card-title">Ali Zain Malik</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Stars Develpor</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item px-4" data-bs-interval="3500">
                    <div class="card d-block w-100 review-card">
                        <div class="card-body">
                            <h5 class="card-title">John Wick</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Continental</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>


                <div class="carousel-item px-4" data-bs-interval="4000">
                    <div class="card d-block w-100 review-card">
                        <div class="card-body">
                            <h5 class="card-title">Ali Zain Malik</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Stars Develpor</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>


                <div class="carousel-item px-4">
                    <div class="card d-block w-100 review-card">
                        <div class="card-body">
                            <h5 class="card-title">Ethan Hunt</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">IMF</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next" >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
    </div>


    <!-- <div class="container comments-div">
        <p class="h6 fw-bold p-4 pb-0">Leave a Comment</p>
        <textarea class="comment-text mx-4 p-2 rounded" placeholder="It has been great"></textarea>
        <div class="comment-btn-div px-4 pb-4">
            <button type="button" class="comment-btn rounded p-2">Comment</button>
        </div>
    </div> -->



<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      <p class="toast-message"></p>
    </div>
  </div>
</div>



    <div class="footer-div">
        <?php include("footer.html") ?>
    </div>

   
</body>
<script src="assets/js/landing_page.js"></script>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/common_actions.js"></script>
<script src="assets/js/search_page.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</html>

