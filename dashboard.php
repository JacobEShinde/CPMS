<?php
require 'dbconn.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupil Management System - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">

        <h2 class="mt-4 mb-4 text-center">Pupils Class Register</h2>
        
        <div class="float-right mt-2">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Rest of your dashboard content remains unchanged -->

        <!-- Add Pupil Modal and other modals -->

        <div class="row">
            <?php
            // Fetch total pupils, males, females
            $attendanceReports = ($conn->query("SELECT COUNT(*) as total_attendance FROM reports")->fetch_assoc())['total_attendance'];
            $totalPupils = $conn->query("SELECT COUNT(*) as count FROM pupils")->fetch_assoc()['count'];
            $totalMales = $conn->query("SELECT COUNT(*) as count FROM pupils WHERE gender = 'm'")->fetch_assoc()['count'];
            $totalFemales = $conn->query("SELECT COUNT(*) as count FROM pupils WHERE gender = 'f'")->fetch_assoc()['count'];
            ?>

            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Pupils</h5>
                        <p class="card-text display-4"><?php echo $totalPupils; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Males</h5>
                        <p class="card-text display-4"><?php echo $totalMales; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Females</h5>
                        <p class="card-text display-4"><?php echo $totalFemales; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Attendance Reports</h5>
                        <p class="card-text display-4"><?php echo $attendanceReports; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-success mb-4"><a href="add_pupil.php">Add New Pupil</a></button>
        <button class="btn btn-success mb-4"><a href="count.php">Mark Register</a></button>
        <!-- Todo: Fix this -->
        <input type="search" name="" id="" placeholder="Search for pupil"> 


        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Exam Number</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Grade</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="pupilList">
                <?php
                // Fetch pupil records
                $result = $conn->query("SELECT * FROM pupils");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['exam_number']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['middle_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['date_of_birth']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['grade']}</td>
                            <td>{$row['contact']}</td>
                            <td>
                                <button class='btn btn-primary btn-sm edit-btn' data-id='{$row['exam_number']}'>Edit</button>
                                <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['exam_number']}'>Delete</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>No pupils found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Pupil Modal -->
    <div class="modal fade" id="addPupilModal" tabindex="-1" aria-labelledby="addPupilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5><a href="add_pupil.php">Add New Pupil</a></h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addPupilForm" action="add_pupil.php">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" class="form-control" id="middleName" name="middleName">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="grade">Grade</label>
                            <input type="text" class="form-control" id="grade" name="grade" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="number" class="form-control" id="contact" name="contact" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Pupil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Pupil Modal -->
    <div class="modal fade" id="editPupilModal" tabindex="-1" aria-labelledby="editPupilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPupilModalLabel">Edit Pupil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editPupilForm">
                        <input type="hidden" id="editPupilId" name="id">
                        <div class="form-group">
                            <label for="editFirstName">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" name="firstName">
                        </div>
                        <div class="form-group">
                            <label for="editMiddleName">Middle Name</label>
                            <input type="text" class="form-control" id="editMiddleName" name="middleName">
                        </div>
                        <div class="form-group">
                            <label for="editLastName">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" name="lastName">
                        </div>
                        <div class="form-group">
                            <label for="editDateOfBirth">Date of Birth</label>
                            <input type="date" class="form-control" id="editDateOfBirth" name="dateOfBirth">
                        </div>
                        <div class="form-group">
                            <label for="editGender">Gender</label>
                            <select class="form-control" id="editGender" name="gender">
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editGrade">Grade</label>
                            <input type="text" class="form-control" id="editGrade" name="grade">
                        </div>
                        <div class="form-group">
                            <label for="editAddress">Address</label>
                            <textarea class="form-control" id="editAddress" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editContact">Contact</label>
                            <input type="number" class="form-control" id="editContact" name="contact">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Pupil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       $(document).ready(function() {
    // Add Pupil
    $('#addPupilForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'add_pupil.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Failed to add pupil: ' + xhr.responseText);
            }
        });
    });


            // Edit Pupil
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'fetch_pupil.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        $('#editPupilId').val(response.id);
                        $('#editFirstName').val(response.first_name);
                        $('#editMiddleName').val(response.middle_name);
                        $('#editLastName').val(response.last_name);
                        $('#editDateOfBirth').val(response.date_of_birth);
                        $('#editGender').val(response.gender);
                        $('#editGrade').val(response.grade);
                        $('#editAddress').val(response.address);
                        $('#editContact').val(response.contact);
                        $('#editPupilModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to fetch pupil data.');
                    }
                });
            });

            $('#editPupilForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'edit_pupil.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function() {
                        alert('Failed to update pupil.');
                    }
                });
            });
        });
    </script>
</body>
</html>
