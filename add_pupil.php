<!DOCTYPE html>
<html>
<head>
    <title>Add New Pupil</title>
    <style>
        form {
            margin-top: 80%;
            max-width: 600px;
            margin: auto;
            padding: 5px;
            background: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form div + div {
            margin-top: 10px;
        }

        label {
            display: block;
            margin-bottom: .15px;
            color: #333333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 5px;
        }

        button {
            padding: 10px;
            color: #f9f9f9;
            background-color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "dbconn.php";

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO pupils (first_name, middle_name, last_name, date_of_birth, grade, address, contact) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $middlename, $lastname, $dateofbirth, $grade, $address, $contact);

        // Set parameters and execute
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $dateofbirth = $_POST['dateofbirth'];
        $grade = $_POST['grade'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        if ($stmt->execute()) {
            // Redirect to dashboard after successful insertion
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close connections
        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="post">
        <div>
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        <div>
            <label for="middlename">Middle Name</label>
            <input type="text" id="middlename" name="middlename">
        </div>
        <div>
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        <div>
            <label for="dateofbirth">Date of Birth</label>
            <input type="date" id="dateofbirth" name="dateofbirth" required>
        </div>
        <div>
            <label for="grade">Grade</label>
            <input type="text" id="grade" name="grade" required>
        </div>
        <div>
            <label for="address">Address</label>
            <textarea id="address" name="address" required></textarea>
        </div>
        <div>
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" required>
        </div>
        <div>
            <button type="submit">Add pupil</button>
        </div>
    </form>
</body>
</html>
