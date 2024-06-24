<?php
require 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = $_POST['firstName'];
    $middle_name = $_POST['middleName'];
    $last_name = $_POST['lastName'];
    $date_of_birth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $grade = $_POST['grade'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("UPDATE pupils SET first_name = ?, middle_name = ?, last_name = ?, date_of_birth = ?, gender = ?, grade = ?, address = ?, contact = ? WHERE id = ?");
    $stmt->bind_param("ssssssisi", $first_name, $middle_name, $last_name, $date_of_birth, $gender, $grade, $address, $contact, $id);

    if ($stmt->execute()) {
        echo "Pupil updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
