<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <?php require_once '../styles.php' ?>
    <style>
        body {
            background: #f9fafc;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: #ffffff !important;
        }

        .navbar-brand span {
            color: #0077cc;
        }

        /* Course Preview Thumbnails */
        .course-thumb {
            position: relative;
            width: 250px;
            height: 150px;
            background-size: cover;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-thumb:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.2);
        }

        /* Play Button Overlay */
        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
            border-radius: 50%;
            padding: 12px;
            transition: 0.3s ease;
        }

        .play-overlay:hover {
            transform: translate(-50%, -50%) scale(1.15);
        }

        /* Payment Options */
        .list-group-item {
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .list-group-item:hover {
            background: #f0f8ff;
        }

        /* Expanding Payment Forms */
        .payment-form {
            display: none;
            margin-top: 10px;
            background: #fdfdfd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: inset 0px 0px 6px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.4s ease-in-out;
        }

        .payment-form input {
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        /* QR Section */
        .qr-box {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px dashed #0077cc;
        }

        /* Hover animations for payment icons */
        .icons img {
            transition: transform 0.3s ease;
        }

        .icons img:hover {
            transform: scale(1.2);
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Buttons */
        .btn-success {
            background: #28a745;
            border: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-outline-info {
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <?php
    require_once '../connection.php';
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }
    if (isset($_REQUEST['id'])) {
        $courseId = $_REQUEST['id'];
        $courseQuery = "SELECT * FROM tblcourses WHERE id = '$courseId'";
        $courseResult = mysqli_query($conn, $courseQuery);
        if (!$courseResult) {
            die("Query failed: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($courseResult) === 0) {
            echo '<p class="text-muted text-center">Course not found.</p>';
        } else {
            $course = mysqli_fetch_assoc($courseResult);
        }
        $courseTitle = $course['title'] ?? null;
        $courseDescription = $course['description'] ?? null;
        $courseInstructor = $course['instructor'] ?? null;
        $coursePrice = $course['price'] ?? null;
        $courseThumbnail = $course['thumbnail'] ?? null;
        $category = $course['category'] ?? null;
        $courseRating = $course['rating'] ?? null;
    }
    ?>
    <nav class="navbar navbar-light bg-light border-bottom shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center">
                <form action="" method="post" class="me-3">
                    <button class="btn btn-outline-info px-3" name="btnBack">
                        &larr; Back
                    </button>
                </form>
                <?php
                if (isset($_REQUEST['btnBack'])) {
                    header("Location: student_overview.php");
                }
                ?>
                <div class="navbar-brand d-flex align-items-center mb-0">
                    <i class="fa-solid fa-book-open me-2 text-primary"></i>
                    <span class="h5 mb-0 fw-bold"> LearnHub</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <div class="container-fluid p-4">
        <h1 class="mb-4 fw-bold text-primary">Course Overview</h1>

        <!-- Video Thumbnails -->
        <div class="d-flex flex-wrap">
            <?php
            $lessonQuery = "SELECT * FROM tbllessons WHERE course_id = '$courseId'";
            $lessonResult = mysqli_query($conn, $lessonQuery);
            if (!$lessonResult) {
                die("Query failed: " . mysqli_error($conn));
            }
            $lessonCount = mysqli_num_rows($lessonResult);

            while ($row = mysqli_fetch_assoc($lessonResult)) {
                $lessonTitle = $row['lesson_title'] ?? null;
                echo '<div class="course-thumb m-2 shadow-sm" style="background-image: url(\'' . $courseThumbnail . '\');">
                        <div id="playButton2" class="play-overlay">
                            <i class="fa-solid fa-circle-play" style="color: white;font-size: 32px;"></i>
                        </div>
                        <div class="course-info p-2 position-absolute bottom-0 start-0 w-100" style="background: rgba(0, 0, 0, 0.5);">
                            <h5 class="course-title" style="color: white;">' . $lessonTitle . '</h5>
                        </div>
                    </div>';

            }
            ?>

        </div>

        <div class="row mt-4">
            <!-- Left Side -->
            <div class="col-lg-6 mb-4">
                <h3 class="fw-bold"><?php echo $courseTitle; ?></h3>
                <p class="text-muted"><?php echo $courseDescription; ?></p>
                <p><strong>Instructor:</strong> <?php echo $courseInstructor; ?></p>
                <p><strong>Price:</strong> <span class="text-success fw-bold">₹<?php echo $coursePrice; ?></span></p>
                <p><strong>Rating:</strong> ⭐<?php echo $courseRating; ?> </p>
                <p><strong>Videos: </strong> <?php echo $lessonCount; ?></p>

                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-light border-0 fw-semibold">
                        💬 Comments
                    </div>
                    <div class="card-body">
                        <?php
                        $commentQuery = "SELECT * FROM tblcomments WHERE course_id = '$courseId'";
                        $commentResult = mysqli_query($conn, $commentQuery);
                        if (!$commentResult) {
                            die("Query failed: " . mysqli_error($conn));
                        }
                        if (mysqli_num_rows($commentResult) === 0) {
                            echo "<p class='text-muted'>No comments yet. Be the first to comment!</p>";
                        }

                        while ($commentRow = mysqli_fetch_assoc($commentResult)) {
                            $commentUser = $commentRow['user_name'] ?? 'Anonymous';
                            $commentText = $commentRow['comment'] ?? '';
                            echo "
                                    <div class='d-flex align-items-start mb-3 p-2 border rounded bg-light'>
                                        <div class='me-2'>
                                            <i class='fa-regular fa-circle-user text-primary' style='font-size: 25px;'></i>
                                        </div>
                                        <div>
                                            <strong>$commentUser</strong>
                                            <p class='mb-1'>$commentText</p>
                                        </div>
                                    </div>
                                ";
                        }
                        ?>


                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-6">
                <h3 class="fw-bold">Payment Options</h3>
                <ul class="list-group">

                    <!-- Credit Card -->
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        onclick="togglePayment('cardForm')">
                        <p class="mb-0 fw-semibold">Credit Card</p>
                        <div class="icons">
                            <img class="mx-1" src="../uploads/icons/rupay.png" height="40">
                            <img class="mx-1" src="../uploads/icons/visa.png" height="40">
                            <img class="mx-1" src="../uploads/icons/mastercard.png" height="40">
                            <img class="mx-1" src="../uploads/icons/credit-card.png" height="40">
                        </div>
                    </li>
                    <div id="cardForm" class="payment-form">
                        <form action="enroll.php" method="post">
                            <input type="text" class="form-control mb-2" placeholder="Card Number" required>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control" placeholder="MM/YY" required>
                                <input type="text" class="form-control" placeholder="CVV" required>
                            </div>
                            <input type="text" class="form-control mt-2" placeholder="Card Holder Name">
                            <input type="hidden" name="courseId" value="<?php echo $courseId; ?>">
                            <input type="hidden" name="coursePrice" value="<?php echo $coursePrice; ?>">
                            <input type="hidden" name="category" value="<?php echo $category; ?>">
                            <button class="btn btn-success mt-3 w-100" name="btnPay">Pay Now</button>
                        </form>
                    </div>

                    <!-- UPI -->
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        onclick="togglePayment('upiForm')">
                        <p class="mb-0 fw-semibold">UPI</p>
                        <div class="icons">
                            <img class="mx-1" src="../uploads/icons/bhim.png" height="40">
                            <img class="mx-1" src="../uploads/icons/gpay.png" height="40">
                            <img class="mx-1" src="../uploads/icons/phone-pe.png" height="40">
                            <img class="mx-1" src="../uploads/icons/paytm.png" height="40">
                        </div>
                    </li>
                    <div id="upiForm" class="payment-form">
                        <p class="mb-2 fw-semibold text-primary text-center">UPI function not working, use Card instead.
                        </p>
                        <div class="qr-box mb-3">
                            <p class="mb-2 fw-semibold text-primary">Scan & Pay</p>
                            <img src="../uploads/icons/qr.png" alt="QR" width="150">
                        </div>
                        <input type="text" class="form-control mb-2" disabled placeholder="Enter UPI ID">
                        <button class="btn btn-success w-100" disabled>Pay via UPI</button>
                    </div>
                </ul>
                
            </div>
        </div>
    </div>

    <script>
        function togglePayment(id) {
            let elem = document.getElementById(id);
            let allForms = document.querySelectorAll('.payment-form');
            allForms.forEach(f => {
                if (f !== elem) f.style.display = "none";
            });
            elem.style.display = (elem.style.display === "block") ? "none" : "block";
        }
    </script>
</body>

</html>