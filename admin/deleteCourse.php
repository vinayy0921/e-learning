<?php
    require_once '../connection.php';

    $course_id = $_POST['courseId'];
    $query = "delete from tblcourses where id = $course_id";
    $result = mysqli_query($conn,$query);

    if($result){
        header('location: admin_courses.php');
    }else{
        echo "error";
    }


?>