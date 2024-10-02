<?php
include("./config.php");
?>

<!DOCTYPE html>
<html lang="en">

<title>Add New User</title>
<?php include("includes/headTag.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>

    /* Removing box shadow from input field */
    #password:focus, #confirm-password:focus
    {
        box-shadow: none;
    }

    .password-div
    {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    /* Applying the shadow to whole div. This is because we have an eye there also. As div is not an input
    field or a link so we need to add within also, so when input inside it is focused it will work. */
    .password-div:focus-within
    {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
    }
</style>
<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/sidebar.php"); ?>
    <main class="main" id="main">
    <div class="container col-lg-6 col-md-6 col-10 py-3 px-4 rounded bg-light shadow-sm" id="profile-edit">
        <!-- Add new user Form -->
        <form id="add-new-user-form" enctype="multipart/form-data">
            <h5 class="text-center fw-bold text-capitalize">Add new user</h5>
            <div class="row mb-2 d-flex flex-column">
                <label for="name" class="col-form-label">Name <span class="text-danger" style="font-size: 14px;">*</span></label>
                <div class="col">
                    <input name="name" type="text" class="form-control" id="name">
                </div>
            </div>

            <div class="row mb-2 d-flex flex-column">
                <label for="email" class="col-form-label">Email <span class="text-danger" style="font-size: 14px;">*</span></label>
                <div class="col">
                    <input name="email" type="email" class="form-control" id="email">
                </div>
            </div>

            <div class="row mb-2 d-flex flex-column">
                <label for="role" class="col-form-label">Role <span class="text-danger" style="font-size: 14px;">*</span></label>
                <div class="col">
                    <select name="role" id="role" class="w-100">
                        <option value="" selected>Select Role</option>
                        <option value="0">Applicant</option>
                        <option value="1">Employer</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
            </div>

            <div class="row mb-2 d-flex flex-column">
                <label for="password" class="col-form-label">Password <span class="text-danger" style="font-size: 14px;">*</span></label>
                <div class="col d-flex align-items-center bg-white mx-auto rounded border border-1 p-0 pe-2 password-div" style="width: 95%;">
                    <input name="password" type="password" class="form-control border-0 w-100" id="password">
                    <i class="ri ri-eye-fill pointer fs-5 eye" data-target="#password"></i>
                </div>
            </div>

            <div class="row mb-2 d-flex flex-column">
                <label for="confirm-password" class="col-form-label">Confirm Password <span class="text-danger" style="font-size: 14px;">*</span></label>
                <div class="col d-flex align-items-center bg-white mx-auto rounded border border-1 p-0 pe-2 password-div" style="width: 95%;">
                    <input name="confirm-password" type="password" class="form-control border-0 w-100" id="confirm-password">
                    <i class="ri ri-eye-fill pointer fs-5 eye" data-target="#confirm-password"></i>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary w-100" id="save-changes-btn" user-id='<?php //echo $user_id; ?>'>Add</button>
            </div>
        </form>
        <!-- End add new user Form -->
        <span class="text-danger" style="font-size: 12px;">Fields with * are mandatory</span>
    </div>

    </main>

    <?php include("includes/footer.php"); ?>

    <?php include("includes/scriptTag.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  

    <script src="assets/js/add_user.js"></script>   
</body>
</html>