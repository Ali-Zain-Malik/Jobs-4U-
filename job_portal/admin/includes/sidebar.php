<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->


  <!-- Start users nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people"></i><span>Users Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="users.php">
            <i class="bi bi-circle"></i><span>Users</span>
          </a>
        </li>
        <li>
          <a href="add_user.php">
            <i class="bi bi-circle"></i><span>Add User</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End users Nav -->

    <!-- Start jobs nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Jobs Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="jobs.php">
            <i class="bi bi-circle"></i><span>Jobs</span>
          </a>
        </li>

        <li>
          <a href="categories.php">
            <i class="bi bi-circle"></i><span>Categories</span>
          </a>
        </li>

      </ul>
    </li>
    <!-- End jobs Nav -->


    <!-- Start skills nav -->
    <li class="nav-item">
      <a class="nav-link collapsed pointer" href="./skills.php">
        <i class="bi bi-award"></i>
        <span>Skills Management</span>
      </a>
    </li>
    <!-- End skills Nav -->


    <!-- Start feedbacks nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="feedbacks.php">
        <i class="bx bxs-comment-dots"></i><span>Feedbacks</span>
      </a>
    </li>
    <!-- End feedbacks Nav -->

<!-- start profile nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li>
    <!-- End Profile Page Nav -->

  </ul>

</aside><!-- End Sidebar-->