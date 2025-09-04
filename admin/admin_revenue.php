<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require('../styles.php'); ?>

    <style>
        /* Fade + slide animation */
        .fade-slide {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
* {
            scrollbar-width: thin;
            scrollbar-color: #636363ff transparent;
        }
        .fade-slide.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hover Effects */
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        .category-item {
            transition: all 0.25s ease;
            border-radius: 6px;
            padding: 0.5rem;
        }

        .category-item:hover {
            background: rgba(0, 123, 255, 0.08);
            transform: scale(1.02);
        }
    </style>
</head>

<body>
    <?php require('admin_header.php'); ?>

    <?php
    require_once '../connection.php';

    $TotalRevenueQuery = "SELECT SUM(amount) AS total_revenue FROM tblpayments";
    $revenueResult = mysqli_query($conn, $TotalRevenueQuery);
    $revenueCount = mysqli_fetch_assoc($revenueResult);
    $totalRevenue = $revenueCount['total_revenue'];
    ?>

    <div class="container-fluid">
        <h4 class="mb-4">Revenue Analytics</h4>

        <!-- Revenue Cards -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-4 mb-3 fade-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Total Revenue</p>
                        <h4 class="mb-0">₹ <?php echo $totalRevenue ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3 fade-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="text-muted small mb-1">This Month</p>
                        <h4 class="mb-0">₹ <?php echo $totalRevenue ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3 fade-slide">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Platform Fee</p>
                        <h4 class="mb-0">₹ 85.00</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue by Category -->
        <div class="card fade-slide">
            <div class="card-header">
                <h6 class="card-title mb-0">Revenue by Course Category</h6>
            </div>
            <div class="card-body">
                <?php
                $categoryRevenueQuery = "SELECT c.category, SUM(p.amount) AS revenue
                                          FROM tblpayments p
                                          JOIN tblmycourses mc ON p.course_id = mc.course_id
                                          JOIN tblcourses c ON mc.course_id = c.id
                                          GROUP BY c.category";
                $categoryRevenueResult = mysqli_query($conn, $categoryRevenueQuery);
                if ($categoryRevenueResult) {
                    while ($row = mysqli_fetch_assoc($categoryRevenueResult)) {
                        $category = $row['category'];
                        $revenue = $row['revenue'];
                        echo "
                        <div class='d-flex justify-content-between align-items-center mb-3 category-item fade-slide'>
                            <span>$category</span>
                            <span>₹ $revenue</span>
                        </div>
                        ";
                    }
                } else {
                    echo "<p class='text-muted'>No category revenue data available.</p>";
                }
                ?>
                
            </div>
        </div>
    </div>

    <?php require_once '../script.php' ?>

    <!-- Scroll Animation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const elements = document.querySelectorAll(".fade-slide");

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("show");
                            observer.unobserve(entry.target); // animate once
                        }
                    });
                },
                { threshold: 0.15 }
            );

            elements.forEach((el) => observer.observe(el));
        });
    </script>
</body>

</html>
