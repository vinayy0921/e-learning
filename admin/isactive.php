<?php
    require_once '../connection.php';

    $user_id = $_POST['user_id'];

    $q = "SELECT is_active FROM tblusers WHERE id = $user_id";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_array($result);
    $is_active = $row['is_active'];

    if($is_active == 0){
        $query = "UPDATE tblusers SET is_active = 1 WHERE id = $user_id";
    }else{
        $query = "UPDATE tblusers SET is_active = 0 WHERE id = $user_id";
    }
    $result = mysqli_query($conn, $query);

    if ($result) {
    header('location: admin_users.php');
    }else{
        echo "error ";
    }

?>