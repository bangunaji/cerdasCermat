<?php
session_start();
$score = $_SESSION['score'];
$wrong_answers = isset($_SESSION['wrong_answers']) ? $_SESSION['wrong_answers'] : [];

// Reset semua sesi setelah permainan selesai
session_destroy();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skor Akhir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container text-center mt-5">
    <h1>Permainan Selesai!</h1>
    <p>Skor Akhir Anda: <strong><?= $score ?></strong></p>

    <!-- Menampilkan soal yang salah dijawab -->
    <?php if (count($wrong_answers) > 0): ?>
        <h3 class="mt-4 text-danger">Soal yang Salah Dijawab:</h3>
        <ul class="list-group">
            <?php foreach ($wrong_answers as $wrong_question): ?>
                <li class="list-group-item">
                    <strong><?= $wrong_question['question'] ?></strong><br>
                    Jawaban yang benar: <?= $wrong_question['option' . $wrong_question['correct']] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Semua jawaban Anda benar!</p>
    <?php endif; ?>

    <a href="index.php" class="btn btn-primary btn-lg mt-4">Main Lagi</a>
</div>

</body>
</html>
