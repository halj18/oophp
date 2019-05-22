<?php
require(__DIR__ . "/src/autoload.php");
require(__DIR__ . "/src/config.php");

//Deal with incoming variables
$number = $_POST["number"] ?? null;
$tries = (int) $_POST["tries"] ?? null;
$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

//Init the game
if ($doInit || $number === null) {
    $number = rand(1, 100);
    $tries = 5;
    //header("Location: index_get.php?tries=$tries&number=$number");
} elseif ($doGuess) {
        $tries -= 1;
    if ($guess === $number) {
        $res = "Correct";
    } elseif ($guess > $number) {
        $res = "Too High";
    } else {
        $res = "Too Low";
    }
}
// Render the page
require __DIR__ . "/view/guess_my_number_post.php";
