<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM teachers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Dump the fetched row for debugging
        echo "<pre>";
        var_dump($row);
        echo "</pre>";

        // Check if 'Password' field exists and is not empty
        if (isset($row['Password']) && !empty($row['Password'])) {
            // Verifying the password with md5 hash
            $stored_hash = $row['Password'];
            
            if (md5($password) === $stored_hash) {
                // Passwords match: Set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $row['email'];
                $_SESSION['teacher_id'] = $row['id'];

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                echo "<div class='alert alert-danger text-center'>Invalid password!</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Password not set for this user!</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>No user found with that email address!</div>";
    }

    $stmt->close();
}

$conn->close();
?>
