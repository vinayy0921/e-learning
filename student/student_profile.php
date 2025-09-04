<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../styles.php'); ?>
    <title>Profile Settings</title>
    <style>
        .profile-header {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: #fff;
            padding: 40px 20px;
            border-radius: 15px;
            text-align: center;
        }

        .profile-header .icon {
            font-size: 80px;
            margin-bottom: 10px;
            color: #0dcaf0;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 500;
        }

        .footer {
            margin-top: 50px;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            padding: 20px 0;
            text-align: center;
            color: #aaa;
        }
        * {
            scrollbar-width: thin;
            scrollbar-color: #636363ff transparent;
        }
    </style>
</head>

<body>
    <?php require_once 'student_header.php'; ?>
    <?php require_once '../connection.php'; ?>

    <div class="container mt-4">
        <!-- Profile Header -->
        <div class="profile-header mb-4">
            <i class="fa-solid fa-circle-user icon"></i>
            <h3 class="mb-1"><?php echo $_SESSION['user_name']; ?></h3>
            <p class="mb-1"><?php echo $_SESSION['user_email']; ?></p>
            <span class="badge bg-info">Student</span>
        </div>

        <!-- Profile Card -->
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title mb-3">Profile Settings</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fa fa-edit"></i> Edit Profile
                    </button>
                    <form action="../logout.php" method="POST">
                        <button class="btn btn-outline-danger" name="btnLogout">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card-custom">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName"
                                value="<?php echo $_SESSION['user_name']; ?>" name="fullName">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                value="<?php echo $_SESSION['user_email']; ?>" name="email">
                        </div>
                        <div class="border p-3 rounded">
                            <h6 class="mb-2">Change Password</h6>
                            <div class="mb-3">
                                <label for="oldPassword" class="form-label">Old Password</label>
                                <input type="password" class="form-control" id="oldPassword"
                                    placeholder="Enter old password" name="oldPassword">
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword"
                                    placeholder="Enter new password" name="newPassword">
                            </div>
                        </div>
                        <p class="text-muted mt-2">Leave password fields empty if you don’t want to change.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="btnUpdate">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Profile Update PHP -->
    <?php
    if (isset($_POST['btnUpdate'])) {
        $newName = mysqli_real_escape_string($conn, $_POST['fullName']);
        $newEmail = mysqli_real_escape_string($conn, $_POST['email']);
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];

        $userId = $_SESSION['user_id'];

        // Get current password from DB
        $checkQuery = "SELECT password FROM tblusers WHERE id = '$userId'";
        $result = mysqli_query($conn, $checkQuery);
        $row = mysqli_fetch_assoc($result);

        $dbPassword = $row['password'];

        if (!empty($oldPassword) && !empty($newPassword)) {
            if ($oldPassword === $dbPassword) {
                $updateQuery = "UPDATE tblusers SET name='$newName', email='$newEmail', password='$newPassword' WHERE id='$userId'";
            } else {
                echo "<script>alert('Old password is incorrect!');</script>";
                $updateQuery = "";
            }
        } else {
            $updateQuery = "UPDATE tblusers SET name='$newName', email='$newEmail' WHERE id='$userId'";
        }

        if (!empty($updateQuery) && mysqli_query($conn, $updateQuery)) {
            $_SESSION['user_name'] = $newName;
            $_SESSION['user_email'] = $newEmail;
            echo "<script>alert('Profile updated successfully!'); window.location.href='student_profile.php</script>";
        } elseif (!empty($updateQuery)) {
            echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 E-Learning Platform. All rights reserved.</p>
    </div>

    <?php require_once '../script.php'; ?>
</body>

</html>
