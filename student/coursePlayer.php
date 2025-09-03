<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Player</title>
    <?php require_once '../styles.php' ?>
    <style>
        /* Overlay Play Button */
        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 64px;
            color: white;
            border-radius: 50%;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.3s;
            background-color: transparent;
        }

        .play-overlay:hover {
            opacity: 1;
        }

        .completed-badge {
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 6px;
        }

        .lesson-item {
            cursor: pointer;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .lesson-item:hover {
            background: #f0f0f0;
            /* light hover */
        }

        .lesson-item.active {
            background: #007bff;
            color: white;
            font-weight: bold;
        }

        .footer {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
        }

        .footer h6 {
            color: #f1f1f1;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .footer-link {
            display: block;
            color: #aaa;
            margin-bottom: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: #0dcaf0;
            transform: translateX(5px);
        }

        .social-link {
            color: #aaa;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            color: #0dcaf0;
            transform: scale(1.2);
        }
    </style>
</head>

<body>

    <?php
    session_start();
    require_once '../connection.php';

    $course_id = $_GET['courseID'];

    $query1 = "SELECT * FROM tblcourses WHERE id=$course_id";
    $query2 = "SELECT * from tbllessons WHERE course_id=$course_id";
    $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($conn, $query2);
    $course = mysqli_fetch_array($result1);


    $course_title = $course["title"];
    $course_description = $course["description"];
    $course_instructor = $course["instructor"];

    ?>

    <div class="container-fluid py-4">
        <div class="mb-4">
            <form action="student_my_courses.php">
                <button class="btn btn-link text-decoration-none p-0 mb-3">
                    ← Back to Courses
                </button>
            </form>
        </div>

        <div class="row">
            <!-- Left Section -->

            <div class="col-lg-8">
                <div class="bg-dark rounded mb-4 d-flex align-items-center justify-content-center"
                    style="aspect-ratio: 16/9; position: relative;">

                    <video id="courseVideo" width="100%" height="100%" style="border-radius: 8px; display:block"
                        controls controlsList="nodownload noplaybackrate" disablePictureInPicture>
                        <source src="<?php echo htmlspecialchars($firstLesson['video_path'] ?? ''); ?>"
                            type="video/mp4"> Your browser does not support the video tag.
                    </video>

                    <!-- Custom Play Button -->
                    <div id="playButton" class="play-overlay">
                        <i class="fa-solid fa-circle-play"></i>
                    </div>
                </div>

                <h1 class="h3 mb-2"><?php echo $course_title ?></h1>
                <p class="text-muted">by <?php echo $course_instructor ?></p>

                <!-- Tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#transcript" type="button">
                            Transcript
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#resources" type="button">
                            Resources
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#comments" type="button">
                            Comments
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">
                    <!-- Transcript -->
                    <div class="tab-pane fade show active" id="transcript">
                        <div class="card">
                            <div class="card-body">
                                <p class="small"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Resources -->
                    <div class="tab-pane fade" id="resources">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Downloadable Resources</h6>
                            </div>
                            <div class="card-body">
                                <!-- <ul class="list-unstyled small">
                                    <li><a href="files/lesson1.pdf" target="_blank">📄 Lesson Notes (PDF)</a></li>
                                    <li><a href="files/code.zip" target="_blank">💻 Example Code</a></li>
                                </ul> -->
                                <p>No resource Available</p>
                            </div>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="tab-pane fade" id="comments">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="" method="post">
                                    <textarea class="form-control mb-3"
                                        placeholder="Ask a question or share your thoughts..." rows="3"
                                        name="comment"></textarea>
                                    <button class="btn btn-primary btn-sm" name="btnComment">Post Comment</button>
                                </form>
                                <?php
                                if (isset($_POST['btnComment'])) {
                                    $username = $_SESSION['user_name'];
                                    // $course_id = $_POST['courseID'];
                                    $comment = $_REQUEST['comment'] ?? null;

                                    if (!empty($comment)) {
                                        $q = "insert into tblcomments(course_id,user_name,comment) values('$course_id','$username','$comment')";
                                        $res = mysqli_query($conn, $q);
                                    } else {
                                        echo "<p> Empty Comment !";
                                    }

                                }
                                ?>
                            </div>
                        </div>

                        <div class="card">

                            <?php

                            function timeAgo($datetime)
                            {
                                $time = strtotime($datetime);
                                $diff = time() - $time;

                                if ($diff < 60) {
                                    return $diff < 10 ? "Just now" : $diff . " seconds ago";
                                } elseif ($diff < 3600) {
                                    return floor($diff / 60) . " minutes ago";
                                } elseif ($diff < 86400) {
                                    return floor($diff / 3600) . " hours ago";
                                } elseif ($diff < 604800) {
                                    return floor($diff / 86400) . " days ago";
                                } elseif ($diff < 2419200) {
                                    return floor($diff / 604800) . " weeks ago";
                                } else {
                                    return date("M d, Y", $time);
                                }
                            }

                            $q = "select * from tblcomments where course_id=$course_id";
                            $r = mysqli_query($conn, $q);
                            while ($row = mysqli_fetch_array($r)) {
                                $uname = $row['user_name'];
                                $comm = $row['comment'];
                                $created_at = $row['created_at'];
                                $time = timeAgo($created_at);
                                echo "
                                
                                <div class='d-flex align-items-start mb-3 p-2 border rounded bg-light'>
                                    <!-- User Icon -->
                                    <div class='me-2'>
                                        <i class='fa-regular fa-circle-user' style='font-size: 25px;'></i>
                                    </div>
        
                                    <!-- Comment Content -->
                                    <div>
                                        <strong>$uname</strong>
                                        <p class='mb-1'>$comm.</p>
                                        <small class='text-muted'>$time</small>
                                    </div>
                                </div>   
                                                            
                                ";
                            }


                            ?>

                        </div>
                    </div>

                </div>

            </div>

            <!-- Right Section -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Course Content</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php
                            $firstLesson = null;
                            $i = 1;
                            while ($lesson = mysqli_fetch_array($result2)) {
                                $firstLesson = $lesson;
                                echo "
                                <div class='list-group-item d-flex justify-content-between align-items-center lesson-item' data-video='" . htmlspecialchars($lesson['video_path'], ENT_QUOTES) . "'data-transcript='" . htmlspecialchars($lesson['transcript'], ENT_QUOTES) . "'>
                                    <div>
                                        <span class='me-2'>$i</span>
                                        <span class='small ms-2 fw-bold'>" . $lesson['lesson_title'] . "</span>
                                    </div>
                                </div>";
                                $i++;
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <form method="post" action="">

                        <button type="submit" name="markCompleted" class="btn btn-success">
                            Mark as Completed
                        </button>
                    </form>
                    <?php
                    if (isset($_POST['markCompleted'])) {
                        $user_id = $_SESSION['user_id'];

                        $q = "INSERT INTO tblcompleted_courses (user_id, course_id) VALUES ('$user_id', '$course_id')";
                        mysqli_query($conn, $q);

                        $delete = "DELETE FROM tblmycourses WHERE user_id = '$user_id' AND course_id = '$course_id'";
                        $r = mysqli_query($conn, $delete);

                        if ($r) {
                            echo "<script>window.location.href='student_completed_courses.php';</script>";
                            exit();
                        }

                    }


                    ?>

                </div>
            </div>


        </div>
    </div>

    <?php require_once './footer.php' ?>

    <?php require_once '../script.php' ?>

    <script>
        const video = document.getElementById("courseVideo");
        const playBtn = document.getElementById("playButton");
        const transcriptBox = document.querySelector("#transcript .card-body p");
        const lessons = document.querySelectorAll(".lesson-item");

        // Play/Pause overlay
        playBtn.addEventListener("click", () => {
            if (video.paused) {
                video.play();
                playBtn.style.display = "none";
            }
        });
        video.addEventListener("pause", () => playBtn.style.display = "block");
        video.addEventListener("play", () => playBtn.style.display = "none");

        // Switch lessons
        lessons.forEach(item => {
            item.addEventListener("click", () => {
                const newVideo = item.dataset.video;
                const newTranscript = item.dataset.transcript || "No transcript available.";

                // Update video
                video.querySelector("source").src = newVideo;
                video.load();
                video.play();

                // Update transcript
                transcriptBox.textContent = newTranscript;

                // Highlight active
                lessons.forEach(l => l.classList.remove("active"));
                item.classList.add("active");
            });
        });
    </script>

</body>

</html>