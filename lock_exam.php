<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];

    $stmt = $conn->prepare("UPDATE exams SET status = 'locked' WHERE user_id = ? AND status = 'ongoing'");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
?>
