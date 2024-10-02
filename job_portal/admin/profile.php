<?php
include("config.php"); 

if(isset($_SESSION["id"]))
{
  $user_id            =   $_SESSION["id"];
  $userData           =   getUserInfo($user_id);
  // $userData           =   $userData;

}
?>
<!-- My name is Ali Zain -->
<!DOCTYPE html>
<html lang="en">

<title>Profile - <?php echo $userData->userInfo->name; ?></title>
<?php include("includes/headTag.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
<body>

  <!-- ======= Header ======= -->
  <?php include("includes/header.php"); ?>
  <!-- ======= Sidebar ======= -->
  <?php include("includes/sidebar.php"); ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
              <div class="image-div" style="width: 120px; height:120px;">                                                         <!-- We have stored the image in the uploads folder but in database we have just saved image name. So adding the path here.-->
              <img style="width: 100%; height:100%; object-fit:cover;" src="<?php echo (isset($userData->userInfo->profile_pic)) ? "assets/uploads/".$userData->userInfo->profile_pic : 'assets/img/profile-img.jpg' ?>" class="rounded-circle" alt="">
              </div>
              <h2><?php echo $userData->userInfo->name; ?></h2>
              <!-- <h3><?php //echo (isset($userData->experience->designation)) ? $userData->experience->designation : "N/A"; ?></h3> -->
              <div class="social-links mt-2">
                
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" style="font-size: 14px;">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#experience">Experience</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#education">Education</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php echo (isset($userData->userInfo->about)) ? $userData->userInfo->about : "N/A"; ?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $userData->userInfo->name; ?></div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8"><?php //echo (isset($userData->experience->company)) ? $userData->experience->company : "N/A"; ?></div>
                  </div> -->

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?php //echo (isset($userData->experience->designation)) ? $userData->experience->designation : "N/A"; ?></div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Location</div>
                    <div class="col-lg-9 col-md-8"><?php echo (isset($userData->country->country_name)) ? $userData->city->city_name . " " . "<b>". $userData->country->country_name ."</b>" : "N/A"; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $userData->userInfo->email; ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="edit-form" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="img-div" style="width: 120px; height: 120px; border-radius: 50%;">
                        <img id="image" style="width: 100%; height: 100%; object-fit: cover;" src="<?php echo (isset($userData->userInfo->profile_pic)) ? "assets/uploads/".$userData->userInfo->profile_pic : 'assets/img/profile-img.jpg' ?>" class="rounded-circle" alt="">
                        </div>
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" id="upload-btn" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <input type="file" id="file-input" name="profile_pic" accept=".png, .jpg, jpeg, tiff" style="display: none;">
                          <a href="#" class="btn btn-danger btn-sm" id="delete-image" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo $userData->userInfo->name; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo (isset($userData->userInfo->about)) ? $userData->userInfo->about : "N/A"; ?></textarea>
                      </div>
                    </div>

                    <!-- <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="<?php //echo (isset($userData->experience->company)) ? $userData->experience->company : "N/A"; ?>">
                      </div>
                    </div> -->

                    <!-- <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="<?php //echo (isset($userData->experience->designation)) ? $userData->experience->designation : "N/A"; ?>">
                      </div>
                    </div> -->

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo $userData->userInfo->email; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="date-of-birth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="date-of-birth" type="date" class="form-control" id="date-of-birth" value="<?php echo $userData->userInfo->date_of_birth; ?>">
                      </div>
                    </div>

                    <div class="row mb-3 d-flex align-items-center">
                      <label for="location" class="col-md-4 col-lg-3 col-form-label">Location</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="select-country" id="select-country">
                          <option value="<?php echo (isset($userData->country->country_id)) ? $userData->country->country_id : ""; ?>"><?php echo (isset($userData->country->country_name)) ? $userData->country->country_name : "Select Country"; ?></option>
                          <?php echo getAllCountries(); ?>
                        </select>

                        <div class="my-2"></div>

                        <select name="select-city" id="select-city">
                          <option value="<?php echo (isset($userData->city->id)) ? $userData->city->id : ""; ?>"><?php echo (isset($userData->city->city_name)) ? $userData->city->city_name : "Select City"; ?></option>
                          <?php echo getAllCities($userData->country->id); ?>
                        </select>
                        
                      </div>
                    </div>

                    
                  <!-- This condition will help us identify whether the profile being viewed is 
                  of applicant or employer. So that we can add option to show that particular
                  employer in the top employers cart in my landing page.  
                  -->
                  
                    <!-- Top employer condition ends here. -->

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" id="save-changes-btn" user-id='<?php echo $user_id; ?>'>Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade experience" id="experience">
                  <div class="add-experience-icon">
                    <i class="bi bi-plus fs-1 pointer plus-icon" title="Add Experience" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                  </div>
                  <div class="experience container px-0 mt-2">
                    <?php getExperience($user_id); ?>
                  </div>
                </div>


                <div class="tab-pane fade education" id="education">
                  <div class="add-education-icon">
                    <i class="bi bi-plus fs-1 pointer education-plus-icon" title="Add Education" data-bs-toggle="modal" data-bs-target="#addEducation"></i>
                  </div>
                  <div class="education container px-0 mt-2">
                    <?php getEducation($user_id); ?>
                  </div>
                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form id="change-password-form">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword" required>
                        <div class="invalid-feedback">Please enter current password</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                        <div class="invalid-feedback">Please provide a new password</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                        <div class="invalid-feedback">Please confirm your new password</div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" id="save-pass-chng-btn">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->





<!-- Modal for adding experience -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="add-experience-form">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold modal-heading" id="staticBackdropLabel">Add Experience</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="company">Compnay <span style="color: red; font-size: 10px;">*</span></label>
          <input type="text" name="company" class="form-control" id="company">
        </div>
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="designation">Designation <span style="color: red; font-size: 10px;">*</span></label>
          <input type="text" name="designation" class="form-control" id="designation">
        </div>




        <div class="d-flex flex-column fw-semibold fs-6 mb-3 start-date-div">
          <label for="employement-type">Employement Criteria <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="employement-type" id="employement-type" class="w-50">
              <option value="">Employement Type</option>
              <option value="full time">Full Time</option>
              <option value="part time">Part Time</option>
              <option value="contract">Contract</option>
              <option value="temporary">Temporary</option>
              <option value="internship">Internship</option>
            </select>

            <select name="location-type" id="location-type" class="w-50">
              <option value="">Location Type</option>
              <option value="on-site">On-site</option>
              <option value="remote">Remote</option>
              <option value="hybrid">Hybrid</option>
            </select>
          </div>
        </div>




        <div class="my-3">
          <input type="checkbox" name="currently-working" id="currently-working" checked class="pointer form-check-input">
          <label for="currently-working" class="pointer">I am currently working here</label>
        </div>

        <div class="d-flex flex-column fw-semibold fs-6 mb-3 start-date-div">
          <label for="start-month">Start Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="start-month" id="start-month" class="w-50">
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

            <select name="start-year" id="start-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>



        <div class="d-none flex-column fw-semibold fs-6 mb-3 end-date-div">
          <label for="end-month">End Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="end-month" id="end-month" class="w-50">
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

            <select name="end-year" id="end-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary experience-save-btn" user-id="<?php echo $user_id; ?>">Save</button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- End adding modal  -->








<!-- Modal for displaying and editing experience -->
<div class="modal fade" id="editViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="edit-experience-form">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Edit Experience</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="edit-company">Compnay <span style="color: red; font-size: 10px;">*</span></label>
          <input type="text" name="edit-company" class="form-control" id="edit-company">
        </div>
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="edit-designation">Designation <span style="color: red; font-size: 10px;">*</span></label>
          <input type="text" name="edit-designation" class="form-control" id="edit-designation">
        </div>




        <div class="d-flex flex-column fw-semibold fs-6 mb-3 start-date-div">
          <label for="edit-employement-type">Employement Criteria <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="edit-employement-type" id="edit-employement-type" class="w-50">
              <option value="">Employement Type</option>
              <option value="full time">Full Time</option>
              <option value="part time">Part Time</option>
              <option value="contract">Contract</option>
              <option value="temporary">Temporary</option>
              <option value="internship">Internship</option>
            </select>

            <select name="edit-location-type" id="edit-location-type" class="w-50">
              <option value="">Location Type</option>
              <option value="on-site">On-site</option>
              <option value="remote">Remote</option>
              <option value="hybrid">Hybrid</option>
            </select>
          </div>
        </div>




        <div class="my-3">
          <input type="checkbox" name="edit-currently-working" id="edit-currently-working" class="pointer form-check-input">
          <label for="edit-currently-working" class="pointer">I am currently working here</label>
        </div>

        <div class="d-flex flex-column fw-semibold fs-6 mb-3 start-date-div">
          <label for="edit-start-month">Start Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="edit-start-month" id="edit-start-month" class="w-50">
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

            <select name="edit-start-year" id="edit-start-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>



        <div class="d-none flex-column fw-semibold fs-6 mb-3 edit-end-date-div">
          <label for="edit-end-month">End Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="edit-end-month" id="edit-end-month" class="w-50">
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

            <select name="edit-end-year" id="edit-end-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary experience-edit-btn">Make Changes</button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- End edit view modal -->













<!-- Modal for adding education -->
<div class="modal fade" id="addEducation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="add-education-form">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold modal-heading" id="staticBackdropLabel">Add Education</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="major">Course of Study <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex gap-2">
            <select name="program" id="program" style="width: 35%;">
              <option value="">Program</option>
              <option value="fsc">Fsc</option>
              <option value="bachelors">Bachelors</option>
              <option value="masters">Masters</option>
            </select>
            <input type="text" name="major" id="major" class="form-control" placeholder="Major e.g Engineering">
          </div>
        </div>
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="institute">Institute <span style="color: red; font-size: 10px;">*</span></label>
          <input type="text" name="institute" class="form-control" id="institute">
        </div>




        <div class="my-3">
          <input type="checkbox" name="currently-studying" id="currently-studying" checked class="pointer form-check-input">
          <label for="currently-studying" class="pointer">Currently Studying here</label>
        </div>

        <div class="d-flex flex-column fw-semibold fs-6 mb-3 start-date-div">
          <label for="edu-start-month">Start Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="edu-start-month" id="edu-start-month" class="w-50">
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

            <select name="edu-start-year" id="edu-start-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>



        <div class="d-none flex-column fw-semibold fs-6 mb-3 edu-end-date-div">
          <label for="edu-end-month">End Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="edu-end-month" id="edu-end-month" class="w-50">
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

            <select name="edu-end-year" id="edu-end-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>


        <div class="d-none flex-column fw-semibold fs-6 mb-3 grade-div">
          <label for="grade">Grade <span style="color: red; font-size: 10px;">*</span></label>
          <select name="grade" id="grade">
            <option value="">Grade</option>
            <option value="a+">A+</option>
            <option value="a-">A-</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary education-save-btn" user-id="<?php echo $user_id; ?>">Save</button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- End education adding modal  -->








<!-- Modal for editing education -->
<div class="modal fade" id="editEducation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="edit-education-form">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold modal-heading" id="staticBackdropLabel">Edit Education</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="edit-major">Course of Study <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex gap-2">
            <select name="edit-program" id="edit-program" style="width: 35%;">
              <option value="">Program</option>
              <option value="fsc">Fsc</option>
              <option value="bachelors">Bachelors</option>
              <option value="masters">Masters</option>
            </select>
            <input type="text" name="edit-major" id="edit-major" class="form-control" placeholder="Major e.g Engineering">
          </div>
        </div>
        <div class="d-flex flex-column fw-semibold fs-6 mb-3">
          <label for="edit-institute">Institute <span style="color: red; font-size: 10px;">*</span></label>
          <input type="text" name="edit-institute" class="form-control" id="edit-institute">
        </div>




        <div class="my-3">
          <input type="checkbox" name="edit-currently-studying" id="edit-currently-studying" class="pointer form-check-input">
          <label for="edit-currently-studying" class="pointer">Currently Studying here</label>
        </div>

        <div class="d-flex flex-column fw-semibold fs-6 mb-3 edit-start-date-div">
          <label for="edit-edu-start-month">Start Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="edit-edu-start-month" id="edit-edu-start-month" class="w-50">
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

            <select name="edit-edu-start-year" id="edit-edu-start-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>



        <div class="d-none flex-column fw-semibold fs-6 mb-3 edit-edu-end-date-div">
          <label for="edit-edu-end-month">End Date <span style="color: red; font-size: 10px;">*</span></label>
          <div class="d-flex w-100 gap-1">
            <select name="edit-edu-end-month" id="edit-edu-end-month" class="w-50">
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

            <select name="edit-edu-end-year" id="edit-edu-end-year" class="w-50">
              <option value="">Year</option>
              <?php for($i = date("Y"); $i > 1924; $i--) 
                {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
              ?> 
            </select>
          </div>
        </div>


        <div class="d-none flex-column fw-semibold fs-6 mb-3 edit-grade-div">
          <label for="edit-grade">Grade <span style="color: red; font-size: 10px;">*</span></label>
          <select name="edit-grade" id="edit-grade">
            <option value="">Grade</option>
            <option value="a+">A+</option>
            <option value="a-">A-</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary education-edit-btn">Make Changes</button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- End education editing modal  -->



<?php include("includes/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("includes/scriptTag.php"); ?>
<script src="assets/js/view_profile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>




</body>

</html>