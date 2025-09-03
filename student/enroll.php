<?php
session_start();
require_once '../connection.php';
if (isset($_POST['btnPay'])) {
    $user_id = $_SESSION['user_id'];
    $courseId = $_POST['courseId'];
    $coursePrice = $_POST['coursePrice'];
    $category = $_POST['category'];
    $enrollment_date = date('d-m-Y');

    // Check if already enrolled
    $checkEnrolled = "SELECT id FROM tblmycourses WHERE user_id = '$user_id' AND course_id = '$courseId'";
    $resultCheck = mysqli_query($conn, $checkEnrolled);

    if (mysqli_num_rows($resultCheck) > 0) {
        echo "<script>alert('You are already enrolled in this course.'); 
              window.location.href='student_overview.php';</script>";
        exit;
    } else {
        // Insert into enrollments
        $courseQuery = "INSERT INTO tblmycourses (user_id, course_id, enrolled_at) 
                        VALUES ('$user_id', '$courseId', '$enrollment_date')";

        // Insert into payments
        $payQuery = "INSERT INTO tblpayments (user_id, course_id, amount, paid_at, category) 
                     VALUES ('$user_id', '$courseId', '$coursePrice', '$enrollment_date', '$category')";

        $result1 = mysqli_query($conn, $courseQuery);
        $result2 = mysqli_query($conn, $payQuery);

        if ($result1 && $result2) {
            echo "<script>alert('Payment successful! You are now enrolled.');
            window.location.href='student_my_courses.php';
            </script>";
            exit();
        } else {
            echo "<script>alert('Enrollment failed. Please try again.');</script>";
        }
    }
}


?>