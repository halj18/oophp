<?php
require(__DIR__ . "/src/autoload.php");
require(__DIR__ . "/src/config.php");

// Start the named session,
session_name("halj18guess");
session_start();

$guess = $_POST["guess"] ?? null;
$guess = (int) $guess;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

if (!isset($_SESSION["game"]) || $doInit) {
    $_SESSION["game"] = new Guess();//No arguments, to use default.
}

$game = $_SESSION["game"];
//var_dump($game);
//Deal with incoming variables
//$number = $_POST["number"] ?? null;
$number = $game->number() ?? null;
//$tries = (int) $_POST["tries"] ?? null;
$tries = (int) $game->tries() ?? null;
/*var_dump($number);
$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;*/

//Init the game
/*if ($doInit || $number === null) {
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
}*/
if ($doGuess) {
    try {
        $res=$game->makeGuess($guess);
    } catch (GuessException $e) {
        $res =  "The guess have to be an integer between 1 and 100.";
    }
}
// Render the page
//require __DIR__ . "/view/guess_my_number_post.php";
require __DIR__ . "/view/guess_my_number_session.php";
