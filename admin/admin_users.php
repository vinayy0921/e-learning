<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require('../styles.php'); ?>

    <style>
        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: #636363ff transparent;
        }

        tbody tr {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        tbody tr.show {
            animation: fadeSlideIn 0.6s ease forwards;
        }
    </style>
</head>

<body>
    <?php require('admin_header.php'); ?>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>User Management</h4>
            <div class="d-flex gap-2">
                <div class="d-flex text-center">
                    <input type="text" class="form-control" placeholder="Search users..." />
                    <button class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"
                            style="font-size:16px"></i></button>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Courses</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../connection.php';

                        $query = "SELECT * FROM tblusers";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) === 0) {
                            echo "No Users";
                        } else {
                            while ($row = mysqli_fetch_array($result)) {
                                $id = $row["id"];
                                $name = $row["name"];
                                $email = $row["email"];
                                $joined_date = $row["created_at"];
                                $is_active = $row["is_active"];

                                $q = "SELECT COUNT(*) as total_courses FROM tblmycourses WHERE user_id = $id";
                                $r = mysqli_query($conn, $q);
                                $data = mysqli_fetch_array($r);
                                $total_courses = $data['total_courses'];

                                if ($is_active == 1) {
                                    $status = "<span class='text-success'>Active</span>";
                                    $status_button = "<form action='isactive.php' method='post'>
                                        <input type='hidden' value='$id' name='user_id'>
                                        <button class='btn btn-outline-danger btn-sm' type='submit'>
                                            <i class='fa-solid fa-user-slash me-1'></i>Deactivate
                                        </button>
                                    </form>";
                                } else {
                                    $status = "<span class='text-danger'>Deactive</span>";
                                    $status_button = "<form action='isactive.php' method='post'>
                                        <input type='hidden' value='$id' name='user_id'>
                                        <button class='btn btn-outline-success btn-sm' type='submit'>
                                            <i class='fa-solid fa-user-check me-1'></i>Activate
                                        </button>
                                    </form>";
                                }

                                echo "<tr>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <i class='fa-regular fa-circle-user me-2' style='font-size: 30px;'></i>
                                            <div>
                                                <p class='small mb-0 fw-medium'>$name</p>
                                                <p class='text-muted mb-0' style='font-size: 0.75rem'>$email</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$status</td>
                                    <td class='small'>$joined_date</td>
                                    <td class='small'>$total_courses</td>
                                    <td>
                                        <div class='d-flex gap-1'>
                                            <button class='btn btn-outline-secondary btn-sm'
                                                data-bs-toggle='modal' data-bs-target='#exampleModal'
                                                data-user-id='$id'
                                                data-user-name='$name'
                                                data-user-email='$email'
                                                data-user-joined='$joined_date'>
                                                <i class='fa-regular fa-eye me-1'></i>View
                                            </button>
                                            $status_button
                                        </div>
                                    </td>
                                </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fa-regular fa-circle-user mb-3" style="font-size: 100px;"></i>
                    <h5 class="mb-0"></h5>
                    <p class="text-muted small mb-0"></p>
                    <p class="text-muted small mb-3"></p>

                    <h6 class="fw-bold text-start mt-3">Courses Enrolled:</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Course</th>
                                    <th>Instructor</th>
                                    <th>Date Enrolled</th>
                                </tr>
                            </thead>
                            <tbody id="coursesList">
                                <!-- Data will be injected -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../script.php'; ?>

    <script>
        // Animate rows
        document.addEventListener("DOMContentLoaded", () => {
            const rows = document.querySelectorAll("tbody tr");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            rows.forEach(row => observer.observe(row));
        });

        // Handle modal
        document.querySelectorAll('#exampleModal').forEach(modal => {
            modal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-user-id');
                const userName = button.getAttribute('data-user-name');
                const userEmail = button.getAttribute('data-user-email');
                const userJoined = button.getAttribute('data-user-joined');

                const modalTitle = modal.querySelector('.modal-title');
                const modalBodyName = modal.querySelector('.modal-body h5');
                const modalBodyEmail = modal.querySelector('.modal-body p:nth-of-type(1)');
                const modalBodyJoined = modal.querySelector('.modal-body p:nth-of-type(2)');
                const coursesList = modal.querySelector('#coursesList'); 

                modalTitle.textContent = `Details of ${userName}`;
                modalBodyName.textContent = userName;
                modalBodyEmail.textContent = userEmail;
                modalBodyJoined.textContent = `Joined on: ${userJoined}`;
                coursesList.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>`;

                // Fetch courses dynamically
                fetch(`fetch_courses.php?user_id=${userId}`)
                    .then(res => res.json())
                    .then(data => {
                        coursesList.innerHTML = "";

                        if (data.length === 0) {
                            coursesList.innerHTML = `
                        <tr>
                            <td colspan="3" class="text-center text-muted">No courses enrolled yet</td>
                        </tr>`;
                        } else {
                            data.forEach(course => {
                                coursesList.innerHTML += `
                            <tr>
                                <td>${course.title}</td>
                                <td>${course.instructor}</td>
                                <td>${new Date(course.enrolled_at).toLocaleDateString()}</td>
                            </tr>`;
                            });
                        }
                    })
                    .catch(err => console.error(err));
            });
        });

    </script>
</body>

</html>