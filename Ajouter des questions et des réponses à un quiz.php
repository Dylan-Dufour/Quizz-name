<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$quiz_id = $_GET['quiz_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ajout de la question
    $question = $_POST['question'];

    $sql = "INSERT INTO questions (quiz_id, question) VALUES ('$quiz_id', '$question')";
    if ($conn->query($sql) === TRUE) {
        $question_id = $conn->insert_id;
        foreach ($_POST['answers'] as $key => $answer) {
            $is_correct = isset($_POST['correct_answer'][$key]) ? 1 : 0;
            $sql_answer = "INSERT INTO answers (question_id, answer, is_correct) 
                           VALUES ('$question_id', '$answer', '$is_correct')";
            $conn->query($sql_answer);
        }
        echo "Question ajoutée avec succès!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter des Questions</title>
</head>
<body>
    <h1>Ajouter des Questions au Quiz</h1>
    <form method="post">
        <label for="question">Question :</label>
        <input type="text" id="question" name="question" required><br><br>

        <label>Réponses :</label><br>
        <input type="text" name="answers[]" required><br>
        <input type="checkbox" name="correct_answer[]" value="1"> Correcte<br><br>
        
        <input type="text" name="answers[]" required><br>
        <input type="checkbox" name="correct_answer[]" value="2"> Correcte<br><br>
        
        <button type="submit">Ajouter la question</button>
    </form>
</body>
</html>