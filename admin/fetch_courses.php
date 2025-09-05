<?php
require_once '../connection.php';

$userId = intval($_GET['user_id'] ?? 0);

$query = "SELECT c.title, c.instructor, mc.enrolled_at
          FROM tblmycourses mc
          JOIN tblcourses c ON mc.course_id = c.id
          WHERE mc.user_id = $userId";

$result = mysqli_query($conn, $query);

$courses = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($courses);
