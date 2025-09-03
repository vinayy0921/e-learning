<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Course</title>
    <?php require_once '../styles.php' ?>

    <style>
        body {
            background: #f4f6f9;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .page-header .icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: #e9f2ff;
            color: #0d6efd;
        }

        .card-surface {
            background: #fff;
            border: 0;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .08);
        }

        .section-title {
            font-weight: 600;
            color: #2d2f33;
            margin-bottom: 12px;
        }

        .soft-note {
            font-size: .9rem;
            color: #6c757d;
        }

        .lesson-card {
            border: 2px dashed #e5e7eb;
            border-radius: 14px;
            background: #fafafa;
            padding: 18px;
            transition: .25s;
        }

        .lesson-card:hover {
            border-color: #0d6efd;
            background: #f8fbff;
        }

        .rounded-3 {
            border-radius: .8rem !important;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .tag-help {
            font-size: .85rem;
            color: #6c757d;
        }
    </style>
</head>

<body class="py-4">

    <div class="container">
        <div class="page-header">
            <div class="icon"><i class="fa-solid fa-book-open"></i></div>
            <div>
                <h3 class="mb-0">Create a New Course</h3>
                <div class="soft-note">Add all course details and up to 3 lessons with videos, transcripts, and
                    resources.</div>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="row g-4">

                <!-- LEFT COLUMN: Core Course Info -->
                <div class="col-lg-8">
                    <div class="card card-surface p-4">
                        <div class="section-title"><i class="fa-solid fa-circle-info me-2 text-primary"></i>Course
                            Information</div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Course Title</label>
                            <input type="text" class="form-control rounded-3 shadow-sm" name="course_title"
                                placeholder="e.g., Mastering JavaScript Fundamentals" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea class="form-control rounded-3 shadow-sm" name="course_description" rows="4"
                                placeholder="Brief overview of what learners will achieve…" required></textarea>
                        </div>

                        <!-- Instructor -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Instructor</label>
                            <input type="text" class="form-control rounded-3 shadow-sm" name="instructor"
                                placeholder="Instructor full name" required>
                        </div>

                        <div class="row">
                            <!-- Category -->
                            <div class="col-md-10 mb-3">
                                <label class="form-label fw-semibold">Category</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" name="category"
                                    placeholder="e.g., Web Development" required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Duration -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Total Duration</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" name="duration"
                                    placeholder="e.g., 6h 30m" required>
                            </div>

                            <!-- Price -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Price (₹)</label>
                                <input type="number" class="form-control rounded-3 shadow-sm" name="price"
                                    placeholder="e.g., 1499" min="0" step="1" required>
                            </div>
                        </div>

                        <!-- Tags -->
                        <!-- <div class="mb-1">
                                <label class="form-label fw-semibold">Tags</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" name="tags"
                                    placeholder="e.g., javascript, es6, dom, projects">
                            </div>
                            <div class="tag-help">Use comma-separated keywords to improve search (e.g., <em>react,
                                    hooks, components</em>).
                            </div> -->
                    </div>
                </div>

                <!-- RIGHT COLUMN: Thumbnail & Meta -->
                <div class="col-lg-4">
                    <div class="card card-surface p-4">
                        <div class="section-title"><i class="fa-solid fa-image me-2 text-primary"></i>Thumbnail
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control rounded-3 shadow-sm" name="thumbnail" required>
                            <div class="soft-note mt-2">Recommended: 1280×720 (JPG/PNG), under 1MB.</div>
                        </div>

                        <hr class="my-3" />

                        <!-- Lessons Count -->
                        <div class="section-title"><i class="fa-solid fa-list-ol me-2 text-primary"></i>Lessons
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Number of Lessons</label>
                            <select class="form-select rounded-3 shadow-sm" id="lessonCount" name="lesson_count"
                                onchange="renderLessons()" required>
                                <option value="">-- Select --</option>
                                <option value="1">1 Lesson</option>
                                <option value="2">2 Lessons</option>
                                <option value="3">3 Lessons</option>
                            </select>
                        </div>
                        <div class="soft-note">You can add up to 3 lessons in this project version.</div>
                    </div>
                </div>

                <!-- FULL-WIDTH: Dynamic Lessons -->
                <div class="col-12">
                    <div id="lessonsWrapper" class="d-grid gap-3"></div>
                </div>



                <!-- Actions -->
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="reset" class="btn btn-outline-secondary rounded-3 px-4">
                            <i class="fa-solid fa-rotate-left me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4" name="btnCreateCourse">
                            <i class="fa-solid fa-cloud-arrow-up me-2"></i>Create & Publish
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <?php
        require_once '../connection.php';

        if (isset($_REQUEST['btnCreateCourse'])) {

            $newCourseTitle = $_POST['course_title'] ?? null;
            $newCourseDescription = $_POST['course_description'] ?? null;
            $newCourseInstructor = $_POST['instructor'] ?? null;
            $newCourseCategory = $_POST['category'] ?? null;
            $newCoursePrice = $_POST['price'] ?? null;
            $newCourseDuration = $_POST['duration'] ?? null;
            $fileName = basename($_FILES['thumbnail']['name']);
            $uploadDir = '../uploads/thumbnails/';
            $newCourseThumbnail = $uploadDir . $fileName;
            $created_at = date('d-m-Y');

            if (empty($newCourseTitle) || empty($newCourseDescription) || empty($newCourseInstructor) || empty($newCourseCategory) || empty($newCoursePrice) || empty($newCourseDuration)) {
                echo "<script>alert('All fields are required!'); window.history.back();</script>";
                exit;
            } else {
                $query = "insert into tblcourses(title,description,instructor,category,price,thumbnail,duration,created_at) values('$newCourseTitle','$newCourseDescription','$newCourseInstructor','$newCourseCategory','$newCoursePrice','$newCourseThumbnail','$newCourseDuration','$created_at')";
                $result = mysqli_query($conn, $query);
                $lastCourse_id = mysqli_insert_id($conn);
                if (!$result) {
                    echo "<script>alert('Error adding course!'); window.history.back();</script>";
                    return;
                }
            }

            $lesson_count = $_REQUEST["lesson_count"] ?? 0;
            $i = 1;

            while ($i <= $lesson_count) {
                $lesson_no = $i;
                $lesson_title = $_REQUEST["lesson_title_$i"] ?? null;
                $lesson_video_name = $_FILES["lesson_video_$i"]["name"] ?? null;
                $tmp = $_FILES["lesson_video_$i"]["tmp_name"] ?? null;
                if ($lesson_video_name) {
                    $target = "../uploads/videos/" . basename($lesson_video_name);
                    move_uploaded_file($tmp, $target);
                    $lesson_video = $target;
                }

                // $lesson_video = $_REQUEST["lesson_video_$i"] ?? null;
                $lesson_transcript = $_REQUEST["lesson_transcript_$i"] ?? null;

                // Skip if lesson title is empty
                if (!empty($lesson_title)) {
                    $query2 = "INSERT INTO tbllessons(course_id, lesson_number, lesson_title, video_path, transcript) VALUES('$lastCourse_id', '$lesson_no', '$lesson_title', '$lesson_video', '$lesson_transcript')";
                    $resultLesson = mysqli_query($conn, $query2);

                    if (!$resultLesson) {
                        echo "<script>alert('Error adding lesson $lesson_no'); window.history.back();</script>";
                        return;
                    }
                }
                $i++;
            }


            echo "<script>
                    alert('Course added successfully!');
                    window.location.href='admin_courses.php';
                </script>";
            exit;

        }
        ?>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function lessonCard(i) {
            return `
        <div class="lesson-card">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0"><i class="fa-solid fa-book me-2 text-primary"></i>Lesson ${i}</h5>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Lesson ${i} Title</label>
              <input type="text" class="form-control rounded-3 shadow-sm"
                     name="lesson_title_${i}" placeholder="e.g., Introduction & Setup" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Lesson ${i} Video</label>
              <input type="file" class="form-control rounded-3 shadow-sm"
                     name="lesson_video_${i}" accept="video/*" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Transcript (Optional)</label>
            <textarea class="form-control rounded-3 shadow-sm"
                      name="lesson_transcript_${i}" rows="3"
                      placeholder="Paste the spoken content or notes for this lesson…"></textarea>
          </div>

          <div class="mb-1">
            <label class="form-label fw-semibold">Resources (Optional)</label>
            <input type="file" class="form-control rounded-3 shadow-sm"
                   name="lesson_resource_${i}" accept=".pdf,.zip,.doc,.docx,.ppt,.pptx">
          </div>
          <div class="soft-note">Allowed: PDF, ZIP, DOC, PPT (upload slides, code, or worksheets).</div>
        </div>
      `;
        }

        function renderLessons() {
            const count = parseInt(document.getElementById('lessonCount').value || 0, 10);
            const wrapper = document.getElementById('lessonsWrapper');
            wrapper.innerHTML = '';
            if (!count) return;

            for (let i = 1; i <= count; i++) {
                wrapper.insertAdjacentHTML('beforeend', lessonCard(i));
            }
        }
    </script>

</body>

</html>
<?php
ob_end_flush();
?>