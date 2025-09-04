<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require('../styles.php'); ?>
    <style>
        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: #636363ff transparent;
        }

        .course-card {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .course-card.show {
            animation: fadeSlideIn 0.8s ease forwards;
        }
        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
    </style>
</head>

<body>
    <?php require('admin_header.php'); ?>

    <div class="container-fluid content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Courses</h4>
            <form action="createCourse.php" method="post">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="fa-solid fa-plus"></i> Create New Course
                </button>
            </form>
        </div>

        <?php
        require_once '../connection.php';

        $query = "SELECT * FROM tblcourses";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 0) {
            echo '<div class="col-12">
                    <div class="alert alert-info">
                        No course Posted.
                    </div>
                </div>';
        } else {
            echo '<div class="row">';
            while ($row = mysqli_fetch_array($result)) {
                $courseId = $row['id'];
                $courseTitle = $row['title'];
                $courseDescription = $row['description'];
                $courseImage = $row['thumbnail'];
                $courseInstructor = $row['instructor'];
                $courseCategory = $row['category'];
                $coursePrice = $row['price'];
                $courseDateCreated = $row['created_at'];

                echo "
                    <div class='col-12 mb-3'>
                        <div class='course-card'>
                            <div class='card-body border' style='border-radius: 15px; background-color: #f8f9fa;'>
                                <div class='d-flex justify-content-between align-items-start'>
                                    <div class='flex-grow-1'>
                                        <div class='d-flex align-items-center gap-4 mb-2 text-center'>
                                            <img class='img-fluid border rounded-3' src='$courseImage' alt='course image' height='150px' width='150px'>
                                            <div class='d-flex flex-wrap align-items-center justify-content-between gap-4 mb-2'>
                                                <h6 class='card-title mb-0 me-3'>
                                                    $courseTitle
                                                </h6>
                                                <p class='text-muted small mb-3 text-center' style='max-width: 300px;'>
                                                    $courseDescription
                                                </p>
                                                <div>
                                                    <span class='text-muted'>Instructor:</span>
                                                    <p class='mb-0'>$courseInstructor</p>
                                                </div>
                                                <div>
                                                    <span class='text-muted'>Category:</span>
                                                    <p class='mb-0'>$courseCategory</p>
                                                </div>
                                                <div>
                                                    <span class='text-muted'>Price:</span>
                                                    <p class='mb-0'>₹$coursePrice</p>
                                                </div>
                                                <div>
                                                    <span class='text-muted'>Date Created:</span>
                                                    <p class='mb-0'>$courseDateCreated</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='d-flex gap-2 ms-3'>
                                        <form action='deleteCourse.php' method='post'>
                                            <input type='hidden' name='courseId' value='$courseId'>
                                            <button class='btn btn-danger btn-sm' type='submit'>
                                                <i class='fa-solid fa-trash-can me-1'></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <button class='btn btn-outline-secondary m-3 open-comments' 
                                        data-course-id='$courseId' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#commentsModal'>
                                    <i class='fa-solid fa-comment-dots me-2'></i>Comments
                                </button>
                            </div>
                        </div>
                    </div>
                ";
            }
            echo '</div>';
        }
        ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="commentsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentsModalLabel">Comments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3" id="commentsContainer">
                    <!-- Comments will be loaded dynamically here -->
                    <p class="text-muted">Loading comments...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './footer.php' ?>
    <?php require_once '../script.php' ?>

    <script>
        // Animate courses one by one
        document.addEventListener("DOMContentLoaded", () => {
            const cards = document.querySelectorAll(".course-card");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });

            cards.forEach(card => observer.observe(card));

            // Comments modal handling
            document.querySelectorAll(".open-comments").forEach(btn => {
                btn.addEventListener("click", () => {
                    const courseId = btn.getAttribute("data-course-id");
                    const container = document.getElementById("commentsContainer");
                    container.innerHTML = "<p class='text-muted'>Loading comments...</p>";

                    fetch("fetch_comments.php?courseId=" + courseId)
                        .then(res => res.text())
                        .then(data => {
                            container.innerHTML = data;
                        })
                        .catch(() => {
                            container.innerHTML = "<p class='text-danger'>Failed to load comments.</p>";
                        });
                });
            });
        });
    </script>
</body>
</html>
