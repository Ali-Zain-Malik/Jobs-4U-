<?php
include("config.php");
if(!isset($_SESSION["email"]))
{
  header("Location: login.php");
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<title>Admin Panel</title>
<?php include("includes/headTag.php"); ?>

<body>

  <!-- ======= Header ======= -->
  <?php include("includes/header.php"); ?>


  <!-- ======= Sidebar ======= -->
  <?php include("includes/sidebar.php"); ?>

  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            
            <!-- users Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card p-0">

                <div class="card-body p-0 p-3">
                  <h5 class="card-title">Users</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo countUsers(); ?></h6>
                    </div>
                  </div>

                  <div class="row mt-3 py-1">
                    <div class="col-6 text-center border-end border-primary">
                      <div class="content d-flex flex-column align-items-center">
                        <p class="h6 fw-semibold">Employers</p>
                        <span class="employer-number"><?php echo countEmplyerUsers(); ?></span>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div class="content d-flex flex-column align-items-center">
                        <p class="h6 fw-semibold">Applicants</p>
                        <span class="employer-number"><?php echo countApplicantUsers(); ?></span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End users Card -->



            <!-- start jobs posted number card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card p-0">

                <div class="card-body p-0 p-3">
                  <h5 class="card-title">Jobs Posted</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bxs-briefcase-alt-2"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo countJobs(); ?></h6>
                    </div>
                  </div>


                  <div class="row mt-3 py-1">
                    <div class="col-6 text-center border-end border-primary">
                      <div class="content d-flex flex-column align-items-center">
                        <p class="h6 fw-semibold">Live</p>
                        <span class="active-jobs-number"><?php echo countLiveJobs(); ?></span>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div class="content d-flex flex-column align-items-center">
                        <p class="h6 fw-semibold">Pending</p>
                        <span class="active-jobs-number"><?php echo countPendingJobs(); ?></span>
                      </div>
                    </div>
                  </div>


                </div>
              </div>

            </div>
            <!-- End jobs posted card -->


            <!-- Start Feedbacks card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card p-0">

                <div class="card-body p-0 p-3">
                  <h5 class="card-title">Feedbacks</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bxs-comment-dots"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo countFeedbacks(); ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>
            
            <!-- End feedback card -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

         
          <!-- Classification Column -->
          <div class="card">
            <div class="card-body pt-3 pb-0">
              <h5 class="card-title">Classification</h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: <?php echo countEmplyerUsers(); ?>,
                          name: 'Employers'
                        },
                        {
                          value: <?php echo countApplicantUsers() ?>,
                          name: 'Applicants'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Classification column -->

        </div><!-- End Right side columns -->

        <div class="col-12">

          <div class="col-12">
            <?php include("includes/feedback_inner.php") ?>
          </div>


          
          <!-- Line graph -->
          <div class="col-12">
              <div class="card">
                <div class="card-body pt-4">
                  <h5 class="card-title">Reports</h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>


                                <!-- Getting the data for chart -->
              <?php

                $dailyUserCounts = R::getAll("
                  SELECT DATE(signup_date) AS date, COUNT(*) AS count
                  FROM users
                  GROUP BY DATE(signup_date)
                  ORDER BY DATE(signup_date)"
                );

                // Fetch daily counts for jobs
                $dailyJobCounts = R::getAll("
                  SELECT DATE(creation_date) AS date, COUNT(*) AS count
                  FROM jobs
                  GROUP BY DATE(creation_date)
                  ORDER BY DATE(creation_date)"
                );


                $users  = [];
                $jobs   = [];

                foreach($dailyUserCounts as $count)
                {
                  $dates[] = $count['date'];
                  $users[] = (int) $count['count'];
                }

                foreach ($dailyJobCounts as $count) 
                {
                  $jobs[] = (int) $count['count'];
                }


                $dates = array_values(array_unique($dates));

                // Encode PHP arrays to JSON
                $usersJson = json_encode($users);
                $jobsJson = json_encode($jobs);
                $datesJson = json_encode($dates);


                // echo $usersJson . " " . $datesJson . " " . $jobsJson;  exit;

              ?>


                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Users',
                          data: <?php echo $usersJson; ?>,
                        }, {
                          name: 'Jobs',
                          data: <?php echo $jobsJson; ?>
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: <?php echo $datesJson; ?>
                        },
                        yaxis: {
                          title: {
                              text: 'Count'
                          },
                          labels: {
                              formatter: function (value) {
                                  return value.toFixed(0); // Format y-axis labels as whole numbers
                              }
                          },
                          min: 0, // Set minimum value for y-axis
                          max: 100, // Set maximum value for y-axis
                          tickAmount: 5 // Number of ticks on y-axis
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("includes/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  

<?php include("includes/scriptTag.php"); ?>
<script src="assets/js/index.js"></script>

</body>

</html>