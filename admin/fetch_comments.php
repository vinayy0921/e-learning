<?php
require_once '../connection.php';

$courseId = intval($_GET['courseId']);

$query = "SELECT comment, created_at, user_name,is_active
          FROM tblcomments 
          WHERE course_id = $courseId";
$result = mysqli_query($conn, $query);
$commentCount = mysqli_num_rows($result);

if (mysqli_num_rows($result) === 0) {
    echo "<p class='text-muted'>No comments yet.</p>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $isActive = $row['is_active'] ;
        if(!$isActive){
           $isEnableText="Show";
           $btnClass="btn-outline-primary";
        }else{
           $isEnableText="Hide";
           $btnClass="btn-outline-danger";
        }
        echo "
        <div class='card mb-3 border' style='border-radius: 15px; background-color: #f8f9fa;'>
            <div class='card-body d-flex justify-content-between align-items-start'>
                <div>
                    <h6 class='card-title mb-2'>{$row['user_name']}</h6>
                    <p class='card-text mb-0'>{$row['comment']}</p>
                    <p class='text-muted small'>{$row['created_at']}</p>
                    
                </div>
                </div>
                </div>";
            }
        }
        // <button class='btn $btnClass btn-sm rounded m-3'>$isEnableText</button>
