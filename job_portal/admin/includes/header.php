<?php
/* I have not included config.php file here which contains database. This is because
this is a header and it is included in index.php. And index.php contains config.php
file. So no need here. If I do it, many things will override and produce error.  */
// include("config.php");
$email  = $_SESSION["email"];
$user   = R::findOne("users", "email = ?", [$email]);
if($user)
{
  $amdin_name = $user->name;
  $experience = R::findOne("experience", "user_id = ?", [$user->id]);

  if($experience)
  {
    $designation  = $experience->designation;
  }
}
?>

<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.php" class="logo d-flex align-items-center">
    
    <span class="d-none d-lg-block">Jobs 4U</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->



<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <!-- We have stored the image in the uploads folder but in database we have just saved image name. So adding the path here.-->
        <div class="image-div" style="width: 35px; height:35px;">                                                        
                <img style="width: 100%; height:100%; object-fit:cover;" src="<?php echo (isset($user->profile_pic)) ? "assets/uploads/".$user->profile_pic : 'assets/img/profile-img.jpg' ?>" class="rounded-circle" alt="">
        </div>
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $amdin_name; ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?php echo $amdin_name; ?></h6>
          <span><?php echo $designation;  ?></span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="profile.php">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <span class="dropdown-item d-flex align-items-center signOut-span">
            <i class="bi bi-box-arrow-right"></i>
            <span class="sign-out">Sign Out</span>
          </span>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->


<script src="assets/js/header.js"></script>