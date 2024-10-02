<?php
include("./config.php");
?>

<!DOCTYPE html>
<html lang="en">
<title>Skills</title>
<?php include("includes/headTag.php"); ?>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/sidebar.php"); ?>

    <main class="main" id="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div class="div">
                <h1>Skills</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Skills Management</li>
                        <li class="breadcrumb-item active">Skills</li>
                    </ol>
                </nav>
            </div>
            <div class="add-user-div py-3">
                <button type="button" class="btn btn-primary" id="add-skill" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add</button>
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
                                        <th class="table-heading">
                                            <b>S</b>kill
                                        </th>
                                        <th class="table-heading">Status</th>
                                        <th class="table-heading text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo getSkills(); ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>




    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Edit Skill</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="text" class="form-control text-capitalize" id="skill-input" placeholder="Enter a skill" value="">
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <input type="radio" name="radio" id="active" value="1">
                            <label for="active" class="pointer">Activate</label>
                        </div>

                        <div class="d-flex align-items-center gap-2 mt-2">
                            <input type="radio" name="radio" id="deactive" value="0">
                            <label for="deactive" class="pointer">Deactivate</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="edits-save-btn">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Back</button>

                </div>
            </div>
        </div>
    </div>



    <!-- Modal 2 -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Add New Skill</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <div class="mb-3">
            <input type="text" class="form-control" id="new-skill" placeholder="Enter a skill" value="">
          </div>
          <div class="mb-3">
            <div class="d-flex align-items-center gap-2">
              <input type="radio" name="radio2" id="active2" value="1">
              <label for="active2" class="pointer">Activate</label>
            </div>

            <div class="d-flex align-items-center gap-2 mt-2">
              <input type="radio" name="radio2" id="deactive2" value="0">
              <label for="deactive2" class="pointer">Deactivate</label>
            </div>
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add-skill-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>



    <?php include("includes/footer.php"); ?>

    <?php include("includes/scriptTag.php"); ?>
    <script src="assets/js/skills.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" aria-hidden="true"></script>
</body>

</html>