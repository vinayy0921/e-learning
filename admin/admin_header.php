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
            <div class="navbar-brand d-flex align-items-center">
                <i class="fa-solid fa-book-open me-2"></i>
                <span class="h5 mb-0 fw-semibold">LearnHub Admin</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link p-1">
                    <Bell size={16} />
                </button>
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;">
                        <!-- <span class="text-white small"></span> -->
                        <i class="fa-solid fa-circle-user" style="font-size:30px"></i>
                    </div>
                    <span class="small"><?php echo $_SESSION['user_name'] ?></span>
                    <form action="" method="post" >
                        <button class="btn btn-outline-danger p-1 mx-1" name="btnLogout">
                            Logout
                        </button>
                    </form>
                    <?php
                    if (isset($_REQUEST['btnLogout'])) {
                        session_destroy();
                        header("Location: ../index.php");
                        exit();
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</div>

<h2 class="p-4">Welcome <?php echo $_SESSION['user_name']; ?></h2>

<?php
$currentPage = basename($_SERVER['PHP_SELF']); // Gets the current file name
?>
<ul class="nav nav-tabs mb-4" style="justify-content: space-evenly;">
    <li class="nav-item"
        style="<?= $currentPage == 'admin_overview.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="admin_overview.php"
            style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            Overview
        </a>
    </li>
    <li class="nav-item" style="<?= $currentPage == 'admin_courses.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="admin_courses.php"
            style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            Courses
        </a>
    </li>
    <li class="nav-item" style="<?= $currentPage == 'admin_users.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="admin_users.php"
            style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            Users
        </a>
    </li>
    <li class="nav-item" style="<?= $currentPage == 'admin_revenue.php' ? 'border-bottom: 2px solid darkblue;' : '' ?>">
        <a href="admin_revenue.php"
            style="background-color: transparent;border: none; color: darkblue;text-decoration: none;">
            Revenue
        </a>
    </li>
</ul>