<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-learning</title>
    <?php require('styles.php') ?>
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Smooth hover for cards */
       
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
        <div class="container">
            <div class="navbar-brand d-flex align-items-center">
                <i class="fa-solid fa-book-open"></i>
                <span class="h4 mb-0 fw-semibold ms-2">LearnHub</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <form><button class="btn btn-outline-primary" name="btnRegister"> Register </button></form>
                <?php if (isset($_REQUEST['btnRegister'])) {
                    header("Location: register.php");
                } ?>
                <form><button class="btn btn-success" name="btnLogin"> Login </button></form>
                <?php if (isset($_REQUEST['btnLogin'])) {
                    header("Location: login.php");
                } ?>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="py-5 hero">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="display-3 fw-bold mb-4"> Learn Without Limits </h1>
                    <p class="lead text-muted mb-4"> Access thousands of courses taught by expert instructors. Start
                        learning today and advance your career. </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 mb-4">
                        <form>
                            <button class="btn btn-primary btn-lg" name="getStarted"> Get Started Free </button>
                            <button class="btn btn-outline-primary btn-lg" name="watchDemo"> Watch Demo </button>
                        </form>
                        <?php if (isset($_REQUEST['getStarted'])) {
                            header("Location: register.php");
                        }
                        if (isset($_REQUEST['watchDemo'])) {
                            header("Location: demo.php");
                        } ?>
                    </div>
                </div>
                <div class="col-lg-6 text-end" data-aos="zoom-in">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80"
                        alt="Students learning together" class="img-fluid rounded shadow-lg" />
                </div>
            </div>
        </div>
    </section>

    <!-- Site Info -->
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row text-center">
                <div class="col-6 col-lg-3 mb-4" data-aos="flip-left">
                    <h3 class="fw-bold">10K+</h3>
                    <p class="text-muted">Students</p>
                </div>
                <div class="col-6 col-lg-3 mb-4" data-aos="flip-left" data-aos-delay="100">
                    <h3 class="fw-bold">500+</h3>
                    <p class="text-muted">Courses</p>
                </div>
                <div class="col-6 col-lg-3 mb-4" data-aos="flip-left" data-aos-delay="200">
                    <h3 class="fw-bold">5K+</h3>
                    <p class="text-muted">Satisfied Students</p>
                </div>
                <div class="col-6 col-lg-3 mb-4" data-aos="flip-left" data-aos-delay="300">
                    <h3 class="fw-bold">95%</h3>
                    <p class="text-muted">Completion Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose -->
    <section class="py-5" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Why Choose LearnHub?</h2>
                <p class="lead text-muted"> Our platform offers everything you need to succeed in your learning journey
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-center mb-3 rounded"
                                style="width:48px;height:48px;background-color:rgba(3,2,19,0.1);"><i
                                    class="fa-solid fa-book-open"></i></div>
                            <h5 class="card-title mb-3">Expert-Led Courses</h5>
                            <p class="card-text text-muted">Learn from industry professionals with years of experience
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-center mb-3 rounded"
                                style="width:48px;height:48px;background-color:rgba(3,2,19,0.1);"><i
                                    class="fa-solid fa-user-group"></i></div>
                            <h5 class="card-title mb-3">Community Support</h5>
                            <p class="card-text text-muted">Connect with fellow learners and get help when you need it
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-center mb-3 rounded"
                                style="width:48px;height:48px;background-color:rgba(3,2,19,0.1);"><i
                                    class="fa-solid fa-award"></i></div>
                            <h5 class="card-title mb-3">Certificates</h5>
                            <p class="card-text text-muted">Earn verified certificates upon course completion</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-center mb-3 rounded"
                                style="width:48px;height:48px;background-color:rgba(3,2,19,0.1);"><i
                                    class="fa-solid fa-star"></i></div>
                            <h5 class="card-title mb-3">Quality Content</h5>
                            <p class="card-text text-muted">All courses are reviewed and approved by our expert team</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-center mb-3 rounded"
                                style="width:48px;height:48px;background-color:rgba(3,2,19,0.1);"><i
                                    class="fa-regular fa-circle-check"></i></div>
                            <h5 class="card-title mb-3">Flexible Learning</h5>
                            <p class="card-text text-muted">Learn at your own pace with lifetime access to courses </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="500">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-center mb-3 rounded"
                                style="width:48px;height:48px;background-color:rgba(3,2,19,0.1);"><i
                                    class="fa-solid fa-play"></i></div>
                            <h5 class="card-title mb-3">Interactive Learning</h5>
                            <p class="card-text text-muted">Engage with quizzes, assignments, and practical projects</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Students -->
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h3 class="h4 mb-4 text-center">For Students</h3>
            <div class="row">
                <div class="col-lg-6 mb-5" data-aos="fade-right">
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Access to thousands of courses across
                                multiple categories</span></li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Interactive video lessons with
                                transcripts and notes</span></li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Quizzes and assignments to test your
                                knowledge</span></li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Earn certificates upon course
                                completion</span></li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Connect with instructors and fellow
                                students</span></li>
                    </ul>
                </div>
                <div class="col-lg-6 mb-5" data-aos="fade-left">
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Excellent videos, documents, and
                                created quizzes</span></li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Track Your progress and
                                engagement</span></li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>All Courses at reasonable Price</span>
                        </li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Earn certificates upon course
                                completion</span></li>
                        <li class="d-flex align-items-start mb-3"><i
                                class="fa-regular fa-circle-check me-2"></i><span>Analytics and insights to improve your
                                studies</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 text-white" style="background-color:#030213" data-aos="fade-up">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-3">Ready to Start Learning?</h2>
            <p class="lead mb-4" style="opacity:0.9"> Join thousands of students and start your learning journey today
            </p>
            <form><button class="btn btn-light btn-lg" name="getStarted"> Get Started Now </button></form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light border-top py-5" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-book-open me-2"></i>
                        <span class="h5 mb-0 fw-semibold">LearnHub</span>
                    </div>
                    <p class="text-muted"> Empowering learners worldwide with quality education and expert instruction.
                    </p>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="mb-3">Platform</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-muted text-decoration-none">About Us</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">How it Works</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">Careers</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-muted text-decoration-none">Help Center</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">Contact Us</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">Community</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">Status</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="mb-3">Legal</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-muted text-decoration-none">Terms of Service</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">Privacy Policy</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">Cookie Policy</a></li>
                        <li><a href="/" class="text-muted text-decoration-none">GDPR</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-top pt-4 mt-4 text-center">
                <p class="text-muted mb-0">&copy; 2024 LearnHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <?php require('script.php') ?>

    
    <script>
        AOS.init({
            duration: 1000,
            once: false, 
            offset: 100
        });
    </script>
</body>

</html>