<?php
    require_once '../connection.php';
    if (isset($_POST['courseId'])) {
        $course_id = $_POST['courseId'];

        $q = "SELECT is_active FROM tblcourses WHERE id = $course_id";
        $result = mysqli_query($conn, $q);
        $row = mysqli_fetch_array($result);
        $is_active = $row['is_active'];

        if($is_active){
            $query = "UPDATE tblcourses SET is_active = 0 WHERE id = $course_id";
        }else{
            $query = "UPDATE tblcourses SET is_active = 1 WHERE id = $course_id";
        }
        mysqli_query($conn, $query);
        header('location: admin_courses.php');
        exit();
    }

?>