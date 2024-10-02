
<link rel="stylesheet" href="assets/css/notify.css">

<div class="card">
    <div class="card-body">
      
      <!-- Table with stripped rows -->
      <table class="table datatable">
        <thead>
          <tr>
            <th class="table-heading">
              <b>N</b>ame
            </th>
            <!-- <th>Posted By</th> -->
            <th data-type="date" data-format="YYYY/DD/MM" class="table-heading">Post Date</th>
            <!-- <th>Status</th> -->
            <th class="table-heading">Show Comment</th>
            <th class="table-heading">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php echo getFeedbacks(); ?>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
  </div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/notify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/feedbacks_inner.js"></script>