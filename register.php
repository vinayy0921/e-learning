<!DOCTYPE html>
<html lang="en">
<?php
require_once 'connection.php';

if (isset($_REQUEST['btnRegisterSubmit'])) {
    // Get form data
    $fullName = $_REQUEST['fullName'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $confirmPassword = $_REQUEST['confirmPassword'];
    $created_at = date('d-m-Y');

    // Validate form data
    if (strlen($password) < 6) {
        echo "<p class='text-danger'>Password must be at least 6 characters long.</p>";
        return;
    } elseif ($password !== $confirmPassword) {
        echo "<p class='text-danger'>Passwords do not match.</p>";
        return;
    } else {
        // Registration logic here (e.g., save to database)
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub - Register</title>
    <?php
    require('styles.php');
    ?>
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
            <!-- <div class="row justify-content-center"> -->

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

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label fs-5" for="form3Example1cg">Full
                                                Name</label>
                                            <input type="text" id="form3Example1cg" class="form-control form-control-lg"
                                                placeholder="Enter your Full name" name="fullName" required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label fs-5" for="form3Example3cg">
                                                Email</label>
                                            <input type="email" id="form3Example3cg"
                                                class="form-control form-control-lg" placeholder="Enter your Email"
                                                name="email" required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label fs-5" for="form3Example4cg">Password</label>
                                            <input type="password" id="form3Example4cg"
                                                class="form-control form-control-lg" placeholder="Enter your Password"
                                                name="password" required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label fs-5" for="form3Example4cdg">Comfirm
                                                password</label>
                                            <input type="password" id="form3Example4cdg"
                                                class="form-control form-control-lg" placeholder="Repeat your Password"
                                                name="confirmPassword" required />
                                        </div>


                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success btn-block btn-lg text-body"
                                                name="btnRegisterSubmit">Register</button>
                                        </div>

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
            <!-- </div> -->
        </div>
        <!-- </div> -->
    </div>

    <?php require('script.php') ?>
</body>

</html>