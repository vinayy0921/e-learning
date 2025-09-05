<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub - Register</title>
    <?php
    require('styles.php');
    ?>
    <style>
        .btn-register {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white !important;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px 40px;
            border: none;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease-in-out;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            box-shadow: 0 6px 14px rgba(40, 167, 69, 0.4);
            transform: translateY(-2px);
        }

        .btn-register:disabled {
            background: #ccc !important;
            cursor: not-allowed;
            box-shadow: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div
        style=" min-height: '100vh'; background: 'linear-gradient(135deg, rgba(3, 2, 19, 0.05) 0%, rgba(3, 2, 19, 0.1) 100%)' ">
        <nav class="navbar navbar-light bg-light border-bottom">
            <div class="container">
                <div class="d-flex align-items-center">
                    <form action="index.php" method="post">
                        <button class="btn btn-outline-info me-3" name="btnBack">
                            &larr; Back
                        </button>
                    </form>
                    <div class="navbar-brand d-flex align-items-center mb-0">
                        <i class="fa-solid fa-book-open"></i>
                        <span class="h5 mb-0 fw-semibold"> LearnHub</span>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container py-5">
            <div class="text-center">
                <h1 class="display-6 mb-3">Join LearnHub</h1>
                <p class="text-muted mb-5">Register now to get started</p>
            </div>

            <section class="vh-20">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card shadow p-3 mb-5 bg-body rounded" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                    <form method="post">

                                        <div class="form-outline mb-4">
                                            <label class="form-label fs-5" for="fullName">Full Name</label>
                                            <input type="text" id="fullName" class="form-control form-control-lg"
                                                placeholder="Enter your Full name" name="fullName" required />
                                            <small class="text-danger d-block" id="fullNameError"></small>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label fs-5" for="email">Email</label>
                                            <input type="email" id="email" class="form-control form-control-lg"
                                                placeholder="Enter your Email" name="email" required />
                                            <small class="text-danger d-block" id="emailError"></small>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label fs-5" for="password">Password</label>
                                            <input type="password" id="password" class="form-control form-control-lg"
                                                placeholder="Enter your Password" name="password" required />
                                            <small class="text-danger d-block" id="passwordError"></small>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label fs-5" for="confirmPassword">Confirm
                                                password</label>
                                            <input type="password" id="confirmPassword"
                                                class="form-control form-control-lg" placeholder="Repeat your Password"
                                                name="confirmPassword" required />
                                            <small class="text-danger d-block" id="confirmPasswordError"></small>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" id="btnRegister" class="btn btn-block btn-register"
                                                name="btnRegisterSubmit">Register</button>

                                        </div>

                                        <?php
                                        require_once 'connection.php';

                                        if (isset($_REQUEST['btnRegisterSubmit'])) {
                                            $fullName = $_REQUEST['fullName'];
                                            $email = $_REQUEST['email'];
                                            $password = $_REQUEST['password'];
                                            $confirmPassword = $_REQUEST['confirmPassword'];
                                            $created_at = date('d-m-Y');

                                            if (strlen($password) < 6) {
                                                echo "<p class='text-danger'>Password must be at least 6 characters long.</p>";
                                            } elseif ($password !== $confirmPassword) {
                                                echo "<p class='text-danger'>Passwords do not match.</p>";
                                            } else {
                                                $query = "insert into tblusers(name, email, password, created_at) values('$fullName', '$email', '$password', '$created_at')";
                                                $result = mysqli_query($conn, $query);

                                                if ($result) {
                                                    session_start();
                                                    $_SESSION['user_name'] = $fullName;
                                                    $_SESSION['user_id'] = mysqli_insert_id($conn);
                                                    $_SESSION['user_email'] = $email;
                                                    header("location:./student/student_overview.php");
                                                    exit();
                                                } else {
                                                    echo "<p class='text-danger'>Error: " . mysqli_error($conn) . "</p>";
                                                }
                                            }
                                        }
                                        ?>

                                        <p class="text-center text-muted mt-5 mb-0">Have already an account?
                                            <a href="login.php" class="fw-bold text-body"><u>Login here</u></a>
                                        </p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php require('script.php') ?>

    <!-- jQuery Validation Script -->
    <script>
        $(document).ready(function () {
            function validateForm() {
                let fullNameValid = $("#fullNameError").text() === "" && $("#fullName").val().trim() !== "";
                let emailValid = $("#emailError").text() === "" && $("#email").val().trim() !== "";
                let passwordValid = $("#passwordError").text() === "" && $("#password").val().trim() !== "";
                let confirmPasswordValid = $("#confirmPasswordError").text() === "" && $("#confirmPassword").val().trim() !== "";

                if (fullNameValid && emailValid && passwordValid && confirmPasswordValid) {
                    $("#btnRegister").prop("disabled", false);
                } else {
                    $("#btnRegister").prop("disabled", true);
                }
            }

            $("#fullName").blur(function () {
                let val = $(this).val().trim();
                if (val.length < 3) {
                    $("#fullNameError").text("Full name must be at least 3 characters.");
                } else if (!/^[a-zA-Z\s]+$/.test(val)) {
                    $("#fullNameError").text("Full name can only contain letters and spaces.");
                } else {
                    $("#fullNameError").text("");
                }
                validateForm();
            });

            $("#email").blur(function () {
                let val = $(this).val().trim();
                let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!regex.test(val)) {
                    $("#emailError").text("Please enter a valid email.");
                } else {
                    $("#emailError").text("");
                }
                validateForm();
            });

            $("#password").blur(function () {
                let val = $(this).val();
                if (val.length < 6) {
                    $("#passwordError").text("Password must be at least 6 characters.");
                } else {
                    $("#passwordError").text("");
                }
                validateForm();
            });

            $("#confirmPassword").blur(function () {
                let val = $(this).val();
                let pass = $("#password").val();
                if (val !== pass) {
                    $("#confirmPasswordError").text("Passwords do not match.");
                } else {
                    $("#confirmPasswordError").text("");
                }
                validateForm();
            });

            // disable button initially
            $("#btnRegister").prop("disabled", true);
        });
    </script>

</body>

</html>