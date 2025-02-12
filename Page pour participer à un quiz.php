<?php
$quiz_id = $_GET['quiz_id'];
include 'db.php';

$sql = "SELECT * FROM questions WHERE quiz_id = '$quiz_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Participer au Quiz</title>
</head>
<body>
    <h1>Quiz</h1>
    <form method="post" action="submit_quiz.php">
        <?php while($question = $result->fetch_assoc()) { ?>
            <div>
                <p><?php echo $question['question']; ?></p>
                <?php
                $question_id = $question['id'];
                $answer_sql = "SELECT * FROM answers WHERE question_id = '$question_id'";
                $answer_result = $conn->query($answer_sql);
                while($answer = $answer_result->fetch_assoc()) {
                ?>
                    <label>
                        <input type="radio" name="question_<?php echo $question_id; ?>" value="<?php echo $answer['id']; ?>"> 
                        <?php echo $answer['answer']; ?>
                    </label><br>
                <?php } ?>
            </div>
        <?php } ?>
        <button type="submit">Soumettre</button>
    </form>
</body>
</html>
