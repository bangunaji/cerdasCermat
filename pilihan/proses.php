<?php
session_start();
include 'koneksi.php';

$correct = $_POST['correct'];
$answer = isset($_POST['answer']) ? $_POST['answer'] : null;

// Jika waktu habis, otomatis pindah ke soal berikutnya
if (isset($_GET['timeout'])) {
    $_SESSION['question_count'] += 1;
    header('Location: quiz.php');
    exit();
}

$questions = $_SESSION['questions'];
$current_index = $_SESSION['question_count'];
$current_question = $questions[$current_index];

// Jika jawabannya benar
if ($answer == $correct) {
    $_SESSION['score'] += 1;
} else {
    // Menyimpan soal yang dijawab salah
    $_SESSION['wrong_answers'][] = $current_question;
}

$_SESSION['question_count'] += 1;

header('Location: quiz.php');
?>
