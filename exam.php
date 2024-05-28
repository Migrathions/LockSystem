<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, question FROM exams WHERE user_id = ? AND status = 'ongoing'");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$questions = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ujian</title>
    <script>
        let isTabActive = true;
        
        window.onblur = function() {
            if (isTabActive) {
                isTabActive = false;
                alert("Anda telah meninggalkan tab. Ujian terkunci.");
                lockExam();
            }
        };

        function lockExam() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "lock_exam.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("user_id=" + <?php echo $user_id; ?>);
        }
    </script>
</head>
<body>
    <form id="examForm" method="post" action="submit_exam.php">
        <?php foreach ($questions as $question): ?>
            <p><?php echo $question['question']; ?></p>
            <input type="text" name="answer[<?php echo $question['id']; ?>]">
        <?php endforeach; ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
