<?php include("config.php");

?>

<!DOCTYPE html>
<html lang="en">

<title>Jobs</title>
<?php include("includes/headTag.php"); ?>


<style>
  .employer-name:hover, .viewJobFromTitle:hover {
    text-decoration: underline;
    font-weight: 600;
  }
</style>


<body>

  <!-- ======= Header ======= -->
  <?php include("includes/header.php"); ?>

  <!-- ======= Sidebar ======= -->
  <?php include("includes/sidebar.php"); ?>
  <main id="main" class="main">
    <?php getAllJobs(); ?>
    <div class="pagetitle">
      <h1>Jobs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Jobs Management</li>
          <li class="breadcrumb-item active">Jobs</li>
        </ol>
      </nav>
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
                      <b>T</b>itle
                    </th>
                    <th>Employer</th>
                    <th>Approval</th>
                    <th>Feature</th>
                    <th>Posted</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo getAllJobs(); ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->





  <div class="modal fade" id="exampleModalJobs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <div class="container-fluid p-0">
            <h1 class="modal-title fs-5 fw-bold job-title text-capitalize" id="exampleModalLabel"></h1>
            <span class="fw-bold m-0 salary-amount"></span><span class="salary-currency mx-1 text-uppercase" style="font-size: 12px;"></span>/<span class="per-period text-lowercase" style="font-size: 14px;"></span>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="fw-bold company-name text-capitalize"></h5>
          <p class="m-0 d-flex gap-3"><span class="start-date"></span> - <span class="expiry-date"></span></p>
          <p class="m-0 d-flex gap-3"><span class="employement-type text-capitalize"></span> <span class="location-type text-capitalize"></span></p>
          <h6 class="mt-3 fw-bold">Description</h6>
          <p class="description-text"></p>
        </div>
      </div>
    </div>
  </div>



<?php include("includes/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  
<?php include("includes/scriptTag.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/jobs.js"></script>



</body>

</html>