<?php
include("./config.php");
?>

<!DOCTYPE html>
<html lang="en">
<title>Categories</title>
<?php include("includes/headTag.php"); ?>

<style>
    .loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(69, 69, 69, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
</style>

<body>
    <div class="loader" style="display: none;">
        <div class="dot-pulse"></div>
    </div>
    <?php include("includes/header.php"); ?>
    <?php include("includes/sidebar.php"); ?>

    <main class="main" id="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div class="div">
                <h1>Categories</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Skills Management</li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
            </div>
            <div class="add-user-div py-3">
                <button type="button" class="btn btn-primary" id="add-category" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add</button>
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
                                            <b>C</b>ategory
                                        </th>
                                        <th class="table-heading">Jobs</th>
                                        <th class="table-heading">Status</th>
                                        <th class="table-heading text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo getCategories(); ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>




    <!-- Edit category modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="edit-category-form" class="w-100">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Edit Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" class="form-control text-capitalize" id="category-input" name="category-input" placeholder="Enter a category" value="">
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
                        <button type="submit" class="btn btn-primary" id="edits-save-btn">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End edit category modal -->


    <!-- add category modal -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="add-category-form" class="w-100">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Add New Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <input type="text" class="form-control" name="new-category" id="new-category" placeholder="Enter a category" value="">
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
                        <button type="button" class="btn btn-primary" id="add-category-btn">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- End add category modal -->

    <?php include("includes/footer.php"); ?>

    <?php include("includes/scriptTag.php"); ?>
    <script src="assets/js/categories.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" aria-hidden="true"></script>
</body>

</html>