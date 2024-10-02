<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<title>Feedbacks</title>
<?php include("includes/headTag.php"); ?>


<body>

  <!-- ======= Header ======= -->
  <?php include("includes/header.php"); ?>
  <!-- ======= Sidebar ======= -->
  <?php include("includes/sidebar.php"); ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Feedbacks</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Feedbacks</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <?php include("includes/feedback_inner.php") ?>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


<?php include("includes/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<?php include("includes/scriptTag.php"); ?>

</body>

</html>