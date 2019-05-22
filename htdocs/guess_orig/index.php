<?php
// 190427 Cleaned up version of index_post2session, no commented code.
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

// Initate the game
if (!isset($_SESSION["game"]) || $doInit) {
    $_SESSION["game"] = new Guess();//No arguments, to use default.
}

$game = $_SESSION["game"];

//Deal with generated variables
$number = $game->number() ?? null;
$tries = (int) $game->tries() ?? null;

$message = "";//0428
if ($doGuess) {
    try {
        $res = $game->makeGuess($guess);
        $message = $game->message;
    } catch (GuessException $e) {
        //$res =  "The guess have to be an integer between 1 and 100.";
        //$message =  "The guess have to be an integer between 1 and 100.";//0428
        $message = $e->getMessage();
    }
}
// Render the page
require __DIR__ . "/view/guess_my_number_session.php";
require __DIR__ . "/view/debug_session_post_get.php";// för mos' debugger 190516
