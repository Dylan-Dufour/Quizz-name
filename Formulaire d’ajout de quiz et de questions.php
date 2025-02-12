<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est connecté et admin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_quiz'])) {
        // Création du quiz
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "INSERT INTO quizzes (title, description) VALUES ('$title', '$description')";
        if ($conn->query($sql) === TRUE) {
            $quiz_id = $conn->insert_id;
            header("Location: add_questions.php?quiz_id=$quiz_id");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Créer un Quiz</title>
</head>
<body>
    <h1>Créer un nouveau Quiz</h1>
    <form method="post">
        <label for="title">Titre du Quiz:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <button type="submit" name="create_quiz">Créer le Quiz</button>
    </form>
</body>
</html>