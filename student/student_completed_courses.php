<?php
require_once '../connection.php';
session_start();

$user_id = $_SESSION['user_id']; // logged in user

$q = "SELECT c.id, c.title, c.thumbnail, cc.completed_at 
      FROM tblcompleted_courses cc
      JOIN tblcourses c ON cc.course_id = c.id
      WHERE cc.user_id = '$user_id'";
$res = mysqli_query($conn, $q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../styles.php'); ?>
    <title>Completed Courses</title>
    <style>
        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: #636363ff transparent;
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .course-img {
            height: 180px;
            object-fit: cover;
        }

        .completed-badge {
            background: #0dcaf0;
            color: #fff;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #888;
            font-size: 18px;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
        }

        .footer h6 {
            color: #f1f1f1;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .footer-link {
            display: block;
            color: #aaa;
            margin-bottom: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: #0dcaf0;
            transform: translateX(5px);
        }

        .social-link {
            color: #aaa;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            color: #0dcaf0;
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <?php require_once 'student_header.php'; ?>

    <div class="container my-5">
        <h3 class="mb-4 text-center">Completed Courses</h3>

        <div class="row">
            <?php
            $user_id = $_SESSION['user_id'];

            $q = "
            SELECT c.id AS course_id, 
                   c.title, 
                   c.description, 
                   cc.completed_at
            FROM tblcompleted_courses cc
            JOIN tblcourses c ON cc.course_id = c.id
            WHERE cc.user_id = '$user_id'
        ";
            $res = mysqli_query($conn, $q);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg border-0 h-100 course-card">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">
                                    <i class="bi bi-book-fill text-primary"></i>
                                    <?= $row['title']; ?>
                                </h5>
                                <p class="card-text text-muted"><?= $row['description']; ?></p>
                                <p class="small text-secondary">
                                    Completed on: <?= date("d M Y", strtotime($row['completed_at'])); ?>
                                </p>
                                <!-- <a href="downloadCertificate.php?course_id=<?= $row['course_id']; ?>" -->
                                <div class="btn btn-success btn-sm w-100">
                                    <i class="bi bi-award"></i> Download Certificate
                                    <!-- </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-12 text-center text-muted'>
                    <i class='bi bi-emoji-frown fs-1'></i>
                    <p class='mt-2'>No completed courses yet.</p>
                 </div>";
            }
            ?>
        </div>
    </div>

    <?php require_once './footer.php'; ?>
    <?php require_once '../script.php'; ?>
</body>

</html>