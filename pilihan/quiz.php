<?php
session_start();
include 'koneksi.php';

// Inisialisasi variabel sesi jika belum ada
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
if (!isset($_SESSION['question_count'])) {
    $_SESSION['question_count'] = 0;
}

// Ambil semua soal hanya di awal permainan
if (!isset($_SESSION['questions'])) {
    $result = $conn->query("SELECT * FROM questions ORDER BY RAND()");
    $_SESSION['questions'] = $result->fetch_all(MYSQLI_ASSOC);
}

// Ambil soal berdasarkan index saat ini
$current_index = $_SESSION['question_count'];
$questions = $_SESSION['questions'];

if ($current_index >= count($questions)) {
    header('Location: selesai.php');
    exit();
}

$current_question = $questions[$current_index];
$correct_option = $current_question['correct'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerdas Cermat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .timer {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Cerdas Cermat</h1>

    <div class="card p-4">
        <h3 class="mb-3"><?= $current_question['question'] ?></h3>

        <div class="timer mb-3 text-danger" id="timer">20</div>

        <form action="proses.php" method="POST">
            <input type="hidden" name="correct" value="<?= $correct_option ?>">
            <button type="submit" name="answer" value="1" class="btn btn-primary btn-lg w-100 mb-2"><?= $current_question['option1'] ?></button>
            <button type="submit" name="answer" value="2" class="btn btn-primary btn-lg w-100 mb-2"><?= $current_question['option2'] ?></button>
            <button type="submit" name="answer" value="3" class="btn btn-primary btn-lg w-100 mb-2"><?= $current_question['option3'] ?></button>
            <button type="submit" name="answer" value="4" class="btn btn-primary btn-lg w-100"><?= $current_question['option4'] ?></button>
        </form>
    </div>
</div>

<script>
    let timer = 20;
    const timerElement = document.getElementById('timer');

    const countdown = setInterval(() => {
        timer--;
        timerElement.textContent = timer;

        if (timer <= 0) {
            clearInterval(countdown);
            window.location.href = 'proses.php?timeout=true';
        }
    }, 1000);
</script>

</body>
</html>
