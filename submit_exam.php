<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

foreach ($_POST['answer'] as $question_id => $answer) {
    $stmt = $conn->prepare("UPDATE exams SET answer = ?, status = 'completed' WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $answer, $question_id, $user_id);
    $stmt->execute();
}

echo "Jawaban berhasil disimpan!";
?>
