<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'styles.php' ?>
    <style>
        .msgbox {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            padding: 20px;
            background: #fff3f3;
            border: 2px solid #dc3545;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 9999;
            font-family: Arial, sans-serif;
        }

        .msgbox h4 {
            color: #dc3545;
            margin-bottom: 10px;
        }

        .msgbox p {
            color: #333;
            font-size: 16px;
        }

        .msgbox button {
            margin-top: 15px;
            padding: 8px 16px;
            border: none;
            background: #dc3545;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .msgbox button:hover {
            background: #bb2d3b;
        }
    </style>
    <title>Document</title>
</head>

<body>

    <div
        style=" min-height: '100vh'; background: 'linear-gradient(135deg, rgba(3, 2, 19, 0.05) 0%, rgba(3, 2, 19, 0.1) 100%)' ">
        <nav class="navbar navbar-light bg-light border-bottom">
            <div class="container">
                <div class="d-flex align-items-center">
                    <form action="" method="post">
                        <button class="btn btn-outline-info me-3" name="btnBack">
                            <ArrowLeft size={16} class="me-2" />
                            &larr; Back
                        </button>
                    </form>
                    <?php
                    if (isset($_REQUEST['btnBack'])) {
                        header("Location: index.php");
                    }
                    ?>
                    <div class="navbar-brand d-flex align-items-center mb-0">
                        <i class="fa-solid fa-book-open"></i>
                        <span class="h5 mb-0 fw-semibold"> LearnHub</span>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container ">
            <!-- <div class="row justify-content-center"> -->

            <div class="text-center">
                <h1 class="display-6 mb-3">Join LearnHub</h1>
                <p class="text-muted mb-5">Login Now to Continue</p>
            </div>

            <section class="vh-50">
                <div class="container py-2 h-100 border shadow p-3 bg-body rounded" style="border-radius: 15px;">
                    <div class="row d-flex align-items-center justify-content-center h-100">
                        <div class="col-md-6 col-lg-7 col-xl-6">
                            <img src="./uploads/others/bg-login.png" height="100%" width="100%" class="img-fluid"
                                alt="Phone image">
                        </div>
                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                            <form class="my-4">
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="form1Example13" class="form-control form-control-lg"
                                        name="email" required />
                                    <label class="form-label" for="form1Example13">Email address</label>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="form1Example23" class="form-control form-control-lg"
                                        name="password" required />
                                    <label class="form-label" for="form1Example23">Password</label>
                                </div>

                                <!-- Submit button -->
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"
                                        name="btnLogin">Login</button>
                                </div>
                                <?php
                                require_once('connection.php');
                                if (isset($_REQUEST['btnLogin'])) {
                                    $email = $_REQUEST['email'];
                                    $password = $_REQUEST['password'];

                                    // Validate user credentials
                                    $queryAdmin = "SELECT * FROM tbladmin WHERE email = '$email' AND password = '$password'";
                                    $resultAdmin = mysqli_query($conn, $queryAdmin);
                                    if (!$resultAdmin) {
                                        echo "<p class='text-danger'>Error executing query.</p>";
                                        return;
                                    }
                                    if (mysqli_num_rows($resultAdmin) !== 0) {
                                        // Session start
                                        $row = mysqli_fetch_array($resultAdmin);
                                        session_start();
                                        $_SESSION['user_name'] = $row['name'];
                                        $_SESSION['user_id'] = $row['id'];
                                        $_SESSION['user_email'] = $row['email'];

                                        header("Location: ./admin/admin_overview.php");
                                        exit();
                                    } else {
                                        $queryUser = "SELECT * FROM tblusers WHERE email = '$email' AND password = '$password'";
                                        $resultUser = mysqli_query($conn, $queryUser);
                                        if (!$resultUser) {
                                            echo "<p class='text-danger'>Error executing query.</p>";
                                            return;
                                        }
                                        if (mysqli_num_rows($resultUser) === 1) {
                                            // Session start
                                            $row = mysqli_fetch_array($resultUser);
                                            if ($row['is_active'] == 0) {
                                                header("Location: deactivated.php");
                                                exit();
                                            } else {
                                                session_start();
                                                $_SESSION['user_name'] = $row['name'];
                                                $_SESSION['user_id'] = $row['id'];
                                                $_SESSION['user_email'] = $row['email'];

                                                header("Location: ./student/student_overview.php");
                                                exit();
                                            }
                                        } else {
                                            // Invalid credentials
                                            echo "<p class='text-danger'>Invalid email or password.</p>";
                                        }


                                    }

                                }
                                ?>

                                <p class="text-center text-muted mt-5 mb-0">Don't Have an account?
                                    <a href="register.php" class="fw-bold text-body"><u>Register Now</u></a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <?php require('script.php') ?>

</body>

</html>