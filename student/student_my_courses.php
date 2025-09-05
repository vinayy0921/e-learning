<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../styles.php'); ?>
    <style>
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
        * {
            scrollbar-width: thin;
            scrollbar-color: #636363ff transparent;
        }
    </style>
    <title>My Courses</title>
</head>

<body>
    <?php require_once 'student_header.php'; ?>

    <div class="container-fluid">
        <h2 class="mb-4" id='my-courses'>My Courses</h2>
        <!-- Display enrolled courses -->
        <?php

        require_once '../connection.php';

        $user_id = $_SESSION['user_id'];
        $query = "SELECT c.* FROM tblcourses c
              JOIN tblmycourses m ON c.id = m.course_id
              WHERE m.user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result) === 0) {
            echo "
         <div class='card'>
            <div class='card-body text-center py-5'>
                <BookOpen size={48} class='text-muted mb-3' />
                <p class='text-muted'>No courses enrolled yet</p>
                <a href='./student_overview.php' class='btn btn-primary mt-3'>Browse Courses</a>
            </div>
        </div>
        ";
        }else{
            echo "<div class='container'><div class='row'>";
            while ($course = mysqli_fetch_array($result)) {
                // Display course information
                $courseId = $course['id'] ?? null;
                $courseTitle = $course['title'] ?? null;
                $courseDescription = $course['description'] ?? null;
                $courseInstructor = $course['instructor'] ?? null;
                $courseRating = $course['rating'] ?? null;
                $courseDuration = $course['duration'] ?? null;
                $coursePrice = $course['price'] ?? null;
                $courseImage = $course['thumbnail'] ?? null;
                $courseCategory = $course['category'] ?? null;

                echo "
                    <div class='col-md-4 col-lg-3 mb-4'>
                        <div class='card h-100 shadow-sm hover-shadow'>
                            <div style='position: relative; padding-bottom: 56.25%; overflow:hidden '>
                                <img src='$courseImage' alt='image' class='card-img-top'
                                style='
                                position: absolute; top: 0; left: 0; width: 100%; height: 100%; objectFit: cover' />
                                <span class='badge bg-success position-absolute' style='top: 8px; right: 8px'>
                                    $courseCategory
                                </span>
                            </div>

                            <div class='card-body'>
                                <h5 class='card-title'>$courseTitle</h5>
                                <p class='text-muted small'>by $courseInstructor</p>
                                <div class='d-flex align-items-center gap-3 mb-3 small text-muted'>
                                    <div class='d-flex align-items-center'>
                                        <i class='fa-solid fa-star' class='text-warning me-1' style='font-size: 16px;color:goldenrod'></i>
                                        $courseRating
                                    </div>
                                    <div class='d-flex align-items-center'>
                                        <i class='fa-regular fa-clock' class='me-1' style='font-size: 16px;'></i>
                                        $courseDuration
                                    </div>
                                </div>
                                <div class='d-flex justify-content-between align-items-center'>
                                   
                                   <a href='coursePlayer.php?courseID= $courseId' class='btn btn-primary btn-sm'>
                                        Continue
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
            echo "</div></div>";
        }

        if(isset($_POST['btnRemove'])) {
            $courseIdToRemove = $_POST['course_id'];
            $removeQuery = "DELETE FROM tblmycourses WHERE course_id = '$courseIdToRemove' AND user_id = '$user_id'";
            if (mysqli_query($conn, $removeQuery)) {
                echo "<script>alert('Course removed successfully');</script>";
                header("Location: student_my_courses.php");
            } else {
                echo "<p class='text-danger'>Error removing course: " . mysqli_error($conn) . "</p>";
            }
        }

        ?>

    </div>

         <?php require_once './footer.php' ?>

</body>

</html>