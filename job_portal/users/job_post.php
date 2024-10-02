<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/job_post.css">
    <title>Post a Job</title>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="container-md px-5 py-5 main-container">
        <div class="container-fluid pt-2 rounded">
            <p class="h4 text-center fw-bold mb-4">Post a Job</p>

            <div class="form-div d-flex justify-content-center">
                <div class="form d-flex align-items-start flex-column px-5">
                    <label for="job-title" class="fw-bold label">Job Title</label>
                    <input type="text" class="job-title rounded" placeholder="e.g Web Dev">
                    <label for="program" class="fw-bold label">Minimun Education</label>
                    <select class="program w-100 simple-select" style="border: 2px solid orange;">
                        <option>BS</option>
                        <option>Bsc</option>
                        <option>MS</option>
                        <option>Msc</option>
                        <option>Phd</option>
                    </select>

                    <div class="mb-1"></div>

                    <select class="w-100 major" multiple="multiple">
                        <option>Computer Science</option>
                        <option>Information Technology</option>
                        <option>Software Engineering</option>
                        <option>Electrical Engineering</option>
                    </select>

                    <div class="mb-3"></div>
                    
                    <label for="skills" class="fw-bold label">Skills to be Required</label>
                    <select class="w-100 skills" multiple="multiple"></select>
                    
                    <div class="mb-3"></div>
                    
                    
                    <label for="location" class="fw-bold label">Location</label>
                    <select class="location w-100 simple-select">
                        <option>Lahore</option>
                        <option>Karachi</option>
                        <option>Islamabad</option>
                        <option>Faisalabad</option>
                        <option>Multan</option>
                        <option>Sharaqpur Sharif</option>
                    </select>
                    
                    <div class="mb-3"></div>


                    <label for="employement-type" class="fw-bold label">Employement Type</label>
                    <select class="employement-type w-100 simple-select">
                        <option>Full Time</option>
                        <option>Part Time</option>
                    </select>

                    <div class="mb-3"></div>


                    <label for="location-type" class="fw-bold label">Location Type</label>
                    <select class="location-type w-100 simple-select">
                        <option>Onsite</option>
                        <option>Hybrid</option>
                        <option>Remote</option>
                    </select>


                    <div class="mb-3"></div>


                    <label for="currency" class="fw-bold label">Salary</label>
                    <select class="currency w-100 simple-select">
                        <option></option>
                        <option>$ - USD</option>
                        <option>$ - AUD</option>
                        <option>$ - GBP</option>
                        <option>$ - PKR</option>
                        <option>$ - INR</option>
                    </select>

                    <div class="mb-1"></div>
                    <input type="number" placeholder="Amount" class="w-100 salary-amount rounded">


                    <div class="mb-3"></div>

                    <label for="start-date">Start Date</label>
                    <input type="date" min="" class="start-date w-100 px-3 py-1 rounded" name="start-date" id="start-date">

                    <div class="mb-3"></div>

                    <label for="end-date">End Date</label>
                    <input type="date" min="" class="end-date w-100 px-3 py-1 rounded" name="end-date" id="end-date">

                    <div class="mb-3"></div>

                    <label for="description" class="fw-bold label">Job Description</label>
                    <textarea class="description w-100 rounded" placeholder="e.g We need a skilled and passionate person"></textarea>

                    <div class="mb-5"></div>

                   
                    <div class="publish-div d-flex justify-content-center w-100 mb-4">
                        <button type="button" class="publish-btn rounded-pill">Publish</button>
                    </div>

                </div>

            </div>

            

        </div>
    </div>

    <div class="footer-div">
        <?php include("footer.html") ?>
    </div>
</body>

<script src="assets/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="assets/js/job_post.js"></script>
</html>
