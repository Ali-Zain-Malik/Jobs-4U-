<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<title>Users</title>
<?php include("includes/headTag.php"); ?>

<body>

  <!-- ======= Header ======= -->
  <?php include("includes/header.php"); ?>
  <!-- ======= Sidebar ======= -->
  <?php include("includes/sidebar.php"); ?>
  <main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
      <div class="div">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users Management</li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
      </div>
      <div class="add-user-div py-3">
        <a href="./add_user.php"><button type="button" class="btn btn-info text-light fw-bold">Add User</button></a>
      </div>

    </div><!-- End Page Title -->



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Email</th>
                    <th>Sign up Date</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo getAllUsers(); ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

 
<?php include("includes/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
<?php include("includes/scriptTag.php"); ?>
<script src="assets/js/users.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>