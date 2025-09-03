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

        .course-card {
            opacity: 0;
            /* hidden by default */
            transform: translateY(50px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .course-card.show {
            animation: fadeSlideIn 0.8s ease forwards;
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
            $index = 0;
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
                            </div>
                        </div>
                    </div>
                ";
                $index++;
            }
            echo '</div>';
        }
        ?>
    </div>

    <!-- Modal (unchanged) -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Course</h5>
                    
                    <button type="button" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <!-- title -->
                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="courseTitle" name="courseTitle" required>
                        </div>
                        <!-- description -->
                        <div class="mb-3">
                            <label for="courseDescription" class="form-label">Description</label>
                            <textarea name="courseDescription" class="form-control" id="courseDescription" cols="100"
                                rows="3" required name="courseDescription"></textarea>
                        </div>
                        <!-- instructor -->
                        <div class="mb-3">
                            <label for="courseInstructor" class="form-label">Instructor</label>
                            <input type="text" name="courseInstructor" name="courseInstructor" class="form-control"
                                id="courseInstructor" required></input>
                        </div>
                        <!-- category -->
                        <div class="mb-3">
                            <label class="form-label" for="courseCategory">Category</label>
                            <input type="text" class="form-control" name="courseCategory" id="courseCategory" required>
                        </div>
                        <!-- Price -->
                        <div class="mb-3">
                            <label class="form-label" for="coursePrice">Price (in ₹) </label>
                            <input type="number" class="form-control" name="coursePrice" id="coursePrice" required>
                        </div>
                        <!-- Thumbnail -->
                        <div class="mb-3"> 
                            <label class="form-label" for="courseThumbnail">Thumbnail</label>
                            <input type="file" class="form-control" name="courseThumbnail" id="courseThumbnail">
                        </div>
                        <!-- Video -->
                        <div class="mb-3"> <label class="form-label" for="courseVideo">Video</label> 
                        <input type="file" class="form-control" name="courseVideo" id="courseVideo"> 
                    </div> 
                    <!-- Duration -->
                        <div class="mb-3"> <label class="form-label" for="courseDuration">Duration</label> <input
                                type="text" class="form-control" name="courseDuration" id="courseDuration" required>
                        </div> <button type="reset" class="btn btn-outline-info"><i
                                class="fa-solid fa-arrow-rotate-left me-1" style="font-size:13px"></i> Reset</button>
                        <button type="submit" class="btn btn-primary" name="btnCreateCourse">Create & Publish</button>
                    </form>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../script.php' ?>

    <script>
        // Animate courses one by one
        document.addEventListener("DOMContentLoaded", () => {
            const cards = document.querySelectorAll(".course-card");

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        observer.unobserve(entry.target); // animate once
                    }
                });
            }, {
                threshold: 0.2 // 20% of card visible triggers animation
            });

            cards.forEach(card => observer.observe(card));
        });
    </script>
</body>

</html>