<?php

include("./config.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/notify.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/profile_page.css">
    <title>Profile</title>
</head>

<body>
    <?php include("header.php") ?>


    <!-- Loader -->
    <div class="loader d-none justify-content-center align-items-center flex-column">
      <img
        src="assets/img/loader.gif"
        alt=""
        style="object-fit: cover; width: 50px"
      />
    </div>
    <!-- Loader ends here -->

    <form style="margin-top:60px;">
        <!-- Main container containing everthing -->
        <div class="container  d-flex align-items-center flex-column bg-light">
            <!-- Profile Picture -->
            <div class="profile-image-div rounded-circle">
                <img class="profile-image rounded-circle" src="assets/img/my_image.png" alt="">
                <!-- Overlay appearing on hover -->
                <div class="overlay">
                    <i class="bx bxs-camera fs-4" id="camera-icon" title="Upload profile pic"></i>
                    <input type="file" class="profile-image-input" name="profile-image-input">
                </div>
                <!-- overlay ends here -->
            </div>
            <!-- Profile picture ends here -->

            <!-- Save button for profile picture update -->
            <div class="d-flex justify-content-center my-3">
                <button type="button" id="img-save-btn" class="px-2 py-1 border-0 bg-warning fw-semibold rounded-pill d-none save-btn">Save</button>
            </div>
            <!-- Save button ends here -->


            <!-- Name section -->
            <div class="name-div d-flex mb-3">
                <p class="h5 fw-bolder mt-3 name text-center" id="name"><?php echo getUserInfo(getUserId(), "getName") ?></p> <span><i class="bx bxs-pencil fs-5 pointer pencil-icon" title="Edit Name" id="name-pencil"></i></span>
            </div>
            <!-- Name section ends here -->


            <hr style="width: 100%;">


            <!-- Description Section starts here -->
            <div class="description w-100 px-5">
                <h5 class="text-start fw-bold ps-2 d-inline me-1">Description</h5> <sup><i class="bx bxs-pencil fs-5 pointer pencil-icon" id="description-pencil" title="Edit Description"></i></sup>
                <p class="ps-2 mb-0 description-text" style="font-size: 14px; max-height:65px; overflow:hidden;">
                    <!-- nl2br adds line breaks where user has added. Other wise we will get text without line breaks. -->
                    <?php echo nl2br(getUserInfo(getUserId(), "getDescription"))  ?>
                </p>
                <span class="ps-2 pointer seeMore d-none">...See More</span>

                <button type="button" id="desc-save-btn" class="px-2 py-1 my-2 bg-warning border-0 rounded-pill fw-semibold d-none save-btn float-end">Save</button>
            </div>
            <!-- Description section ends here -->


            <hr style="width: 100%;">


            <!-- Skills section starts here -->
            <div class="skills-div w-100 px-5">
                <h5 class="fw-bold text-start ps-2">Skills</h5>

                <select name="skills" id="skills" multiple="multiple" class="col-lg-6 col-12">
                    <?php getSkills(getUserId()); ?>
                </select>

                <div class="d-inline ms-3">
                    <button type="button" id="skills-save-btn" class="bg-warning fw-semibold border-0 px-2 py-1 rounded-pill d-none save-btn">Save</button>
                </div>
            </div>
            <!-- Skills section ends here -->


            <hr style="width: 100%;">


            <!-- Experience heading and plus icon -->
            <div class="d-flex justify-content-between mb-2 w-100 px-5">
                <h5 class="fw-bold ps-2">Experience</h5>
                <i class="bx bx-plus fs-2 pointer exp-plus-icon me-2" title="Add Experience" data-bs-toggle="modal" data-bs-target="#experienceModal"></i>
            </div>
            <!-- Experience heading ends -->

            <!-- Experience cards start here -->
            <div class="container experience row d-flex justify-content-around">
                <?php getExperience(getUserId()); ?>
            </div>
            <!-- Experience cards ends here -->


            <hr style="width: 100%;">

            <!-- Education heading starts here and plus icon -->
            <div class="d-flex justify-content-between mb-2 w-100 px-5">
                <h5 class="fw-bold ps-2">Education</h5>
                <i class="bx bx-plus fs-2 pointer edu-plus-icon me-2" title="Add Education" data-bs-toggle="modal" data-bs-target="#educationModal"></i>
            </div>
            <!-- Education heading ends here -->

            <!-- Education cards start here -->
            <div class="container education row d-flex justify-content-around">
                <?php getEducation(getUserId()) ?>
            </div>
            <!-- Education cards end here -->

        </div>
        <!-- Main container ends here -->


    </form>
    
    
    




    <!-- Experience Modal -->
    <div class="modal fade" id="experienceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex gap-4 flex-column fw-semibold">
                        <div class="d-flex flex-column">
                            <label for="designation">Designation</label>
                            <input id="designation" class="form-control" type="text" placeholder="e.g Front-end developer">
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                        <div class="d-flex flex-column">
                            <label for="company">Company</label>
                            <input id="company" class="form-control" type="text" placeholder="e.g Microsoft">
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="d-flex flex-column w-50">
                                <label for="employement-type">Employement Type</label>
                                <select name="employement-type" id="employement-type" class="form-select">
                                    <option value="full time">Full Time</option>
                                    <option value="part time">Part Time</option>
                                    <option value="contract">Contract</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="internship">Internship</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column w-50">
                                <label for="location-type">Location Type</label>
                                <select name="location-type" id="location-type" class="form-select">
                                    <option value="on-site">On-site</option>
                                    <option value="remote">Remote</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex gap-2 start-date-div">
                            <div class="d-flex flex-column w-50">
                                <label for="start-month">Start Month</label>
                                <select name="start-month" class="form-select" id="start-month">
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">Febraury</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                            <div class="d-flex-flex-column w-50">
                                <label for="start-year">Start Year</label>
                                <select name="start-year" class="form-select" id="start-year">
                                    <option value="">Year</option>
                                    <?php 
                                        for($i = date("Y"); $i > 1924; $i--) 
                                        {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                    ?> 
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                        </div>
                
                        <div class="d-none gap-2 end-date-div">
                            <div class="d-flex flex-column w-50">
                                <label for="end-month">End Month</label>
                                <select name="end-month" class="form-select" id="end-month">
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">Febraury</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                            <div class="d-flex-flex-column w-50">
                                <label for="end-year">End Year</label>
                                <select name="end-year" class="form-select" id="end-year">
                                    <option value="">Year</option>
                                    <?php 
                                        for($i = date("Y"); $i > 1924; $i--) 
                                        {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                    ?> 
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                        </div>


                        <div class="d-flex gap-2">
                            <input type="checkbox" name="currently-working" id="currently-working" checked class="pointer form-check-input">
                            <label for="currently-working" class="pointer fw-light">I am currently working here</label>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="exp-save-btn" class="btn btn-primary w-100">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal ends here -->




    <!-- Education Modal -->
    <div class="modal fade" id="educationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Education</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex gap-4 flex-column fw-semibold">
                        <div class="d-flex gap-2">
                            <div class="d-flex flex-column" style="width: 30%;">
                                <label for="program">Program</label>
                                <select name="program" id="program" class="form-select">
                                    <option value="fsc">Fsc</option>
                                    <option value="bachelors">Bachelors</option>
                                    <option value="masters">Masters</option>
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                            <div class="d-flex flex-column" style="width: 70%;">
                                <label for="major">Major</label>
                                <input type="text" name="major" id="major" class="form-control" placeholder="e.g Engineering">
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <label for="institute">Institute</label>
                            <input id="institute" class="form-control" type="text" placeholder="e.g Oxford">
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                        
                        <div class="d-flex gap-2 start-date-div">
                            <div class="d-flex flex-column w-50">
                                <label for="edu-start-month">Start Month</label>
                                <select name="edu-start-month" class="form-select" id="edu-start-month">
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">Febraury</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                            <div class="d-flex-flex-column w-50">
                                <label for="edu-start-year">Start Year</label>
                                <select name="edu-start-year" class="form-select" id="edu-start-year">
                                    <option value="">Year</option>
                                    <?php 
                                        for($i = date("Y"); $i > 1924; $i--) 
                                        {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                    ?> 
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                        </div>
                
                        <div class="d-none gap-2 edu-end-date-div">
                            <div class="d-flex flex-column w-50">
                                <label for="edu-end-month">End Month</label>
                                <select name="edu-end-month" class="form-select" id="edu-end-month">
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">Febraury</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                            <div class="d-flex-flex-column w-50">
                                <label for="edu-end-year">End Year</label>
                                <select name="edu-end-year" class="form-select" id="edu-end-year">
                                    <option value="">Year</option>
                                    <?php 
                                        for($i = date("Y"); $i > 1924; $i--) 
                                        {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                    ?> 
                                </select>
                                <small class="error-msg fw-light text-danger d-none">This field is required</small>
                            </div>
                        </div>


                        <div class="d-flex gap-2">
                            <input type="checkbox" name="currently-studying" id="currently-studying" checked class="pointer form-check-input">
                            <label for="currently-studying" class="pointer fw-light">I am currently studying here</label>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edu-save-btn" class="btn btn-primary w-100">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal ends here -->





    <div class="footer-div">
        <?php include("footer.html") ?>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/notify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="assets/js/profile_page.js"></script>

    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> -->

</body>

</html>
<script>
    $("#skills").select2();
</script>

<!-- Capitalizing text in options in select2  -->
<style>
    /* Capitalize the selected text in the Select2 input */
    .select2-selection__rendered {
        text-transform: capitalize;
    }

    /* Capitalize the dropdown options text */
    .select2-results__option {
        text-transform: capitalize;
    }

    .slider
    {
        width: 50%; 
        height:100%; 
        background-color: #FAF9F6; 
        position:fixed; 
        top: 60px; 
        right: -100%;
        z-index: 999;
    }
    .slider-active
    {
        right: 0;
        transition: all 0.5s ease;
    }
</style>