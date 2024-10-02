<?php include("./config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/common_attributes.css">
    <link rel="stylesheet" href="assets/css/search_page.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <title>Favorites</title>
</head>

<body>

    <?php include("header.php") ?>


    <div class="featured-jobs-div">
        <div class="featured-heading-div mb-2">
            <h3 id="feature-heading">Favorites</h3>
        </div>

        <div class="featured-content container-fluid">
            <div class="column1 row row-cols-2">
                <?php getFavorites(); ?>
            </div>
        </div>
    </div>



    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Description (Optional)" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Description (Optional)</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="send-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success-popup">Apply</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="applyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="applyModalLabel">Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="h5">Required Skills</p>
                    <ul class="required-skills">
                        <li>HTML</li>
                        <li>CSS</li>
                        <li>Bootstrap</li>
                        <li>JavaScript</li>
                    </ul>


                    <p class="h5 mb-0">Minimum Education</p>
                    <div class="majors-div">
                        <span class="Degree h6 me-1 fw-normal">BS</span><span class="major h6 fw-normal">Software Engineering</span>
                    </div>
                    <div class="majors-div">
                        <span class="Degree h6 me-1 fw-normal">BS</span><span class="major h6 fw-normal">Computer Science</span>
                    </div>


                    <div class="div-for-spacing mb-3"></div>

                    <p class="h5">Job Summary</p>
                    <p class="job-summary">
                        <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores expedita non, nobis ut porro pariatur cum vero reprehenderit voluptate animi rem ipsum ipsam illo nostrum. Optio ex facilis in iste.
                        Ipsam sit quasi cumque nam unde voluptatum ipsum maiores iusto error qui eos, nisi corporis a porro earum aliquid dolor fuga, cupiditate nostrum aspernatur ad, quibusdam officiis accusantium maxime. Eaque.
                        Adipisci ipsa sequi possimus et modi eos sed libero cumque odit accusantium quaerat repellendus eaque obcaecati, repudiandae consequuntur dolorem delectus. Et distinctio corporis asperiores similique optio modi rem at sunt.
                        Corporis, aspernatur rem! Blanditiis ab quasi autem odio illum sunt veniam, molestiae voluptates enim laborum dicta sapiente iure aperiam eius, ex deleniti labore quod aliquid cumque? Laborum at facilis praesentium? -->
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary final-apply-btn" data-bs-target="#staticBackdrop" data-bs-toggle="modal">Apply</button>
                </div>

            </div>
        </div>
    </div>









    <!-- Modal to show the success or failure message of application sent status. -->
    <div class="modal fade" id="success-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="application-success-message">Application Sent Successfully</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary success-popup-close-btn" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>





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
<script src="assets/js/jquery.js"></script>
<!-- <script src="assets/js/search_page.js"></script> -->
<script src="assets/js/common_actions.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</html>