<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

}
if (!isset($_SESSION['user_name'])) {
    header("Location: ../login.php");
    exit();
}
?>
<div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
    <div class="container-fluid">
      <div class="d-flex align-items-center">
        <div class="navbar-brand d-flex align-items-center me-4">
          <i class="fa-solid fa-book-open"></i>
          <span class="h5 mb-0 fw-semibold">LearnHub</span>
        </div>
      </div>
      <div class="d-flex align-items-center gap-3">
        <a class="btn btn-link p-1">
          <!-- <Bell size={16} /> -->
        </a>
        <div class="d-flex align-items-center gap-2 px-4">
          <i class="fa-solid fa-circle-user" style="font-size:40px"></i>
          <span class="small"><?php
           echo $_SESSION['user_name'];
          ?></span>
        </div>
      </div>
    </div>
  </nav>
</div>

<h2 class="p-2 my-4">Welcome <?php echo $_SESSION['user_name']; ?></h2>

<?php
$currentPage = basename($_SERVER['PHP_SELF']); // Gets the current file name
?>
<ul class="nav nav-tabs mb-4" style="justify-content: space-evenly;">
    <li class="nav-item" style="<?= $currentPage == 'student_overview.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="student_overview.php" style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            Browse Courses
        </a>
    </li>
    <li class="nav-item" style="<?= $currentPage == 'student_my_courses.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="student_my_courses.php" style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            My Courses
        </a>
    </li>
    <li class="nav-item" style="<?= $currentPage == 'student_completed_courses.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="student_completed_courses.php" style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            Completed Courses
        </a>
    </li>
    <li class="nav-item" style="<?= $currentPage == 'student_profile.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="student_profile.php" style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            Profile
        </a>
    </li>
</ul>
