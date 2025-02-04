<?php
require "dbconn.php";
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
        <h2 class="mt-4">Pupils Class Register</h2>

        <div class="container" style="margin-top: 50px;">
        <div class="row">
            <?php
            // Fetch total pupils, males, females, and attendance
            $totalPupils = $conn->query("SELECT COUNT(*) as count FROM pupils")->fetch_assoc()['count'];
            $totalMales = $conn->query("SELECT COUNT(*) as count FROM pupils WHERE gender = 'Male'")->fetch_assoc()['count'];
            $totalFemales = $conn->query("SELECT COUNT(*) as count FROM pupils WHERE gender = 'Female'")->fetch_assoc()['count'];
            $attendancePerDay = $conn->query("SELECT COUNT(*) as count FROM attendance WHERE date = CURDATE()")->fetch_assoc()['count'];
            ?>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Pupils</h5>
                        <p class="card-text"><?php echo $totalPupils; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Males</h5>
                        <p class="card-text"><?php echo $totalMales; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Females</h5>
                        <p class="card-text"><?php echo $totalFemales; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Attendance per Day</h5>
                        <p class="card-text"><?php echo $attendancePerDay; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addPupilModal">Add New Pupil</button>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pupil ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Class</th>
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
                        <td>{$row['pupil_id']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['middle_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['date_of_birth']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['class']}</td>
                        <td>
                            <button class='btn btn-primary btn-sm'>Edit</button>
                            <button class='btn btn-danger btn-sm'>Delete</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No pupils found</td></tr>";
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
                <h5 class="modal-title" id="addPupilModalLabel">Add New Pupil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPupilForm">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="form-group">
                        <label for="dateOfBirth">Date of Birth:</label>
                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Class:</label>
                        <input type="text" class="form-control" id="class" name="class" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Pupil</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="scripts.js"></script> 

</body>
</html>
