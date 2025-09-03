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

        .disabled-link {
            pointer-events: none;
            /* disables clicking */
            opacity: 0.6;
            /* faded look */
            cursor: not-allowed;
        }
    </style>
    <title>Discover Courses</title>
</head>

<body style="width: 100vw; overflow-x: hidden;">
    <?php require_once 'student_header.php'; ?>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4 px-5 py-3">
            <h2>Discover Courses</h2>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex position-relative mx-3">
                    <input type="text" class="form-control" placeholder="Search courses..." style="
                        padding-left: '40px'; width: '300px'" />
                    <button class="btn btn-outline-secondary"><i class="fa-solid fa-search"
                            class="position-absolute text-muted"></i></button>
                </div>
                <button class="btn btn-outline-secondary">
                    <i class="fa-solid fa-sort" style="font-size:16px"></i>
                    Sort
                </button>
                <button class="btn btn-outline-secondary mx-2">
                    <i class="fa-solid fa-filter" style="font-size:16px"></i>
                    Filter
                </button>
            </div>
        </div>


        <div class="container">

            <?php
            require_once '../connection.php';

            $courseQuery = "SELECT * FROM tblcourses";
            $result = mysqli_query($conn, $courseQuery);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            if (mysqli_num_rows($result) === 0) {
                echo '<p class="text-muted text-center">No courses Available.</p>';
            } else {
                echo "<div class='row '>";
                while ($course = mysqli_fetch_assoc($result)) {
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
                    
                    $enrollQuery = "SELECT * FROM tblmycourses WHERE user_id = '" . $_SESSION['user_id'] . "' and course_id = '" . $courseId . "'";
                    $enrollResult = mysqli_query($conn, $enrollQuery);
                    if ($enrollResult && mysqli_num_rows($enrollResult) > 0) {
                        $isEnrolled = "Enrolled";
                        $disabled = "disabled-link";
                    } else {
                        $isEnrolled = "Enroll";
                        $disabled = "";
                    }

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
                                        <span class='h5 mb-0'>₹$coursePrice</span>
                                       <a href='course_overview.php?id=$courseId' class='btn btn-primary btn-sm $disabled'>
                                           $isEnrolled
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                ";
                }
                echo '</div>';
            }

            if (isset($_REQUEST['btnEnroll'])) {
                $user_id = $_SESSION['user_id'];
                $course_id = $_REQUEST['course_id'];
                $q = "select price from tblcourses where id='$course_id'";
                $price = mysqli_query($conn, $q);
                $r = mysqli_fetch_array($price);
                $course_price = $r['price'];
                $enrollment_date = date('d-m-Y');

                $checkEnrolled = "SELECT id from tblmycourses WHERE user_id = '$user_id' AND course_id = '$course_id'";
                $resultCheck = mysqli_query($conn, $checkEnrolled);
                if (mysqli_num_rows($resultCheck) > 0) {
                    echo "<script>alert('You are already enrolled in this course.');</script>";
                } else {
                    $query = "INSERT INTO tblmycourses (user_id, course_id, price, enrolled_at) VALUES ('$user_id', '$course_id','$course_price', '$enrollment_date')";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        echo "<script>alert('Enrollment failed. Please try again.');</script>";
                    }
                }
            }
            ?>
        </div>
        <!-- <div class="row p-5">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div style=" position: 'relative'; padding-bottom: '56.25%'; overflow: 'hidden' ">
                        <img src="" alt="image" class="card-img-top"
                            style="
                            position: 'absolute'; top: 0; left: 0; width: '100%'; height: '100%'; objectFit: 'cover'" />
                        <span class="badge bg-primary position-absolute" style="top: '8px'; right: '8px'"> web
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">title</h5>
                        <p class="text-muted small">by instructor</p>

                        <div class="d-flex align-items-center gap-3 mb-3 small text-muted">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star" class="text-warning me-1" style="font-size: 16px;color:goldenrod"></i>
                                rating
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock" class="me-1" style="font-size: 16px;"></i>
                                duration
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">₹price</span>
                            <button class="btn btn-primary btn-sm" onClick={handleOverview}>
                                Overview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- modal -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabIndex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Overview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="text-center mb-3 border" style="height: 250px; width: 100%">
                            <img src=modalCourseImage alt="Course Image" id="modalCourseImage" class="img-fluid rounded"
                                style="max-height: 200px; object-fit: cover;">
                        </div>
                        <h5 id="modalCourseTitle">Course Title</h5>
                        <p id="modalCourseDescription">Course Description</p>
                        <p><strong>Category:</strong> <span id="modalCourseCategory">Category</span></p>
                        <p><strong>Price:</strong> ₹<span id="modalCoursePrice">Price</span></p>
                        <input type="hidden" id="modalCourseId" value="">

                    </div>
                    <div class="modal-footer">
                        <form method="post">
                            <input type="hidden" name="course_id" id="course_id" value="">
                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                data-bs-dismiss="modal" id="modalCourseId" name="btnEnroll">Enroll now</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
            tabIndex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Enrolled Successfully</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        You have successfully enrolled in the course.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#my-courses" data-bs-toggle="tab"
                            data-bs-dismiss="modal">View Course</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './footer.php' ?>

    <?php require_once '../script.php'; ?>
    <script>
        document.querySelectorAll('.overview-btn').forEach(button => {
            button.addEventListener('click', function () {
                let courseId = this.getAttribute('data-id');
                let courseTitle = this.getAttribute('data-title');
                let courseDescription = this.getAttribute('data-description');
                let courseImage = this.getAttribute('data-image');
                let courseCategory = this.getAttribute('data-category');
                let coursePrice = this.getAttribute('data-price');

                document.getElementById('modalCourseId').textContent = courseId;
                document.getElementById('modalCourseTitle').textContent = courseTitle;
                document.getElementById('modalCourseDescription').textContent = courseDescription;
                document.getElementById('modalCourseImage').textContent = courseImage;
                document.getElementById('modalCourseCategory').textContent = courseCategory;
                document.getElementById('modalCoursePrice').textContent = coursePrice;
                document.getElementById('course_id').value = courseId;
            });
        });
    </script>
</body>

</html>