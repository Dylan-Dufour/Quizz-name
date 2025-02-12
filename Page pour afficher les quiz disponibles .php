<?php
include 'db.php';

$sql = "SELECT * FROM quizzes";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Quiz disponibles</title>
</head>
<body>
    <h1>Quiz disponibles</h1>

    <?php while($quiz = $result->fetch_assoc()) { ?>
        <div>
            <h2><?php echo $quiz['title']; ?></h2>
            <p><?php echo $quiz['description']; ?></p>
            <a href="take_quiz.php?quiz_id=<?php echo $quiz['id']; ?>">Commencer le quiz</a>
        </div>
    <?php } ?>
</body>
</html>