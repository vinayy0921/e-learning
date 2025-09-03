<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <?php require '../styles.php'; ?>

  <style>
    /* Card Hover */
    .card {
      border: none;
      border-radius: 12px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
    }

    /* Fade Scroll Animations */
    .fade-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .fade-scroll.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Enrolled Courses rows */
    .course-row {
      background: #f8f9fa;
      border-left: 4px solid #0d6efd;
      transition: transform 0.3s ease, background 0.3s ease;
    }

    .course-row:hover {
      background: #e9f2ff;
      transform: scale(1.02);
    }

    /* Animated badge pulse */
    .badge.bg-success {
      animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.6);
      }
      70% {
        box-shadow: 0 0 0 10px rgba(25, 135, 84, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(25, 135, 84, 0);
      }
    }
  </style>
</head>

<body>
  <?php require('admin_header.php'); ?>

  <?php
  require_once '../connection.php';
  $TotalUsersQuery = "select COUNT(*) as total_users from tblusers";
  $TotalCoursesQuery = "select COUNT(*) as total_courses from tblcourses";
  $TotalRevenueQuery = "SELECT SUM(amount) AS total_revenue FROM tblpayments";

  $userResult = mysqli_query($conn, $TotalUsersQuery);
  $courseResult = mysqli_query($conn, $TotalCoursesQuery);
  $revenueResult = mysqli_query($conn, $TotalRevenueQuery);

  $userCount = mysqli_fetch_assoc($userResult);
  $courseCount = mysqli_fetch_assoc($courseResult);
  $revenueCount = mysqli_fetch_assoc($revenueResult);

  $totalUsers = $userCount['total_users'];
  $totalCourses = $courseCount['total_courses'];
  $totalRevenue = $revenueCount['total_revenue'];
  ?>

  <div class="container-fluid">

    <!-- Stats Cards -->
    <div class="row mb-4">
      <div class="col-md-6 col-lg-4 mb-3 fade-scroll">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted small mb-1">Total Users</p>
                <h4 class="mb-0"><?php echo $totalUsers ?> </h4>
                <p class="text-success small mb-0">
                  <i class="fa-solid fa-arrow-trend-up me-1" style="font-size: 12px;color: green;"></i>
                  +10% this month
                </p>
              </div>
              <i class="fa-solid fa-users" style="font-size: 32px; color: #030213;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-3 fade-scroll">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted small mb-1">Total Courses</p>
                <h4 class="mb-0"><?php echo $totalCourses ?></h4>
                <p class="text-success small mb-0">
                  <i class="fa-solid fa-arrow-trend-up me-1" style="font-size: 12px;color: green;"></i>
                  +10% this month
                </p>
              </div>
              <i class="fa-solid fa-book-open" style="font-size: 32px; color: #030213;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-3 fade-scroll">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted small mb-1">Total Revenue</p>
                <h4 class="mb-0">₹<?php echo $totalRevenue ?></h4>
                <p class="text-muted small mb-0">
                  <i class="fa-solid fa-arrow-trend-up me-1" style="font-size: 12px;color: green;"></i>
                  +10% this month
                </p>
              </div>
              <i class="fa-solid fa-indian-rupee-sign" style="font-size: 32px; color: #030213;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Enrolled Courses + Platform Health -->
    <div class="row">
      <div class="col-lg-8 mb-4 fade-scroll">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title mb-0">Enrolled Courses</h6>
          </div>
          <div class="card-body">
            <?php
            $query = "SELECT c.title, c.instructor, mc.enrolled_at, u.name AS student_name FROM tblmycourses mc
                        JOIN tblcourses c ON mc.course_id = c.id
                        JOIN tblusers u ON mc.user_id = u.id";

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
              $courseTitle = $row['title'];
              $instructor = $row['instructor'];
              $studentName = $row['student_name'];
              $enrolledAt = $row['enrolled_at'];

              echo "
                <div class='d-flex justify-content-between align-items-center p-2 rounded mb-2 course-row'>
                  <div class='col-lg-4'>
                    <p class='small mb-0 fw-medium'>$courseTitle</p>
                    <p class='text-muted' style='font-size: 0.75rem'>by $instructor</p>
                  </div>
                  <div class='d-flex gap-5 align-itmes-center col-lg-4'>
                    <p>$enrolledAt</>
                    <p class='mb-0'>$studentName</p>
                  </div>
                </div>
              ";
            }
            ?>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4 fade-scroll">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title mb-0">Platform Health</h6>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="small">Server Status</span>
              <span class="badge bg-success">Healthy</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="small">Database</span>
              <span class="badge bg-success">Connected</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="small">CDN</span>
              <span class="badge bg-success">Operational</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scroll Animations Script -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const fadeElems = document.querySelectorAll(".fade-scroll");

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
          }
        });
      }, { threshold: 0.2 });

      fadeElems.forEach(el => {
        observer.observe(el);
      });
    });
  </script>
</body>
</html>
