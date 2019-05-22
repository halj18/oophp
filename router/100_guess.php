<?php
// namespace Halj18\Guess;
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the game start
    $game = new Halj18\Guess\Guess();// mos lösning med mitt vendorname, har inga session att starta

    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});

/**
 * Play the game -show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    // Get current settings from the SESSION
    $tries = $_SESSION["tries"] ?? null;// init value 6
    $res = $_SESSION["res"] ?? null;// init value null
    $guess = $_SESSION["guess"] ?? null;// init value null
    $_SESSION["guess"] = null;// use once, set to null
    $_SESSION["res"] = null;// use once, set to null
    $doCheat = $_SESSION["doCheat"] ?? null;
    $number = $_SESSION["number"];

    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "tries" => $tries,
        "number" => $number ?? null,
        "doCheat" => $doCheat ?? null,
        "doGuess" => $doGuess ?? null
    ];

    $app->page->add("guess/play", $data);// ref to view-file
    // $app->page->add("guess/debug");// ref to view-file to show on same page

    return $app->page->render([
        "title" => $title,
    ]);// echo "Some debugging information";
});

/**
 * Play the game - make a guess.
 */
$app->router->post("guess/play", function () use ($app) {
    // Deal with incomming variables.
    $guess = $_POST["guess"] ?? null;
    $guess = (int) $guess;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    // Get current settings from the SESSION
    $number = $_SESSION["number"];
    $tries = $_SESSION["tries"];

    if ($doGuess) {
        try {
            $game = new Halj18\Guess\Guess($number, $tries);
            $res = $game->makeGuess($guess);
            $_SESSION["tries"] = $game->tries();
            $_SESSION["res"] = $res;
            $_SESSION["guess"] = $guess;
            // $message = $game->message;
        } catch (GuessException $e) {
            //$res =  "The guess have to be an integer between 1 and 100.";
            //$message =  "The guess have to be an integer between 1 and 100.";//0428
            // $message = $e->getMessage();
            $res = $e->getMessage();
        }
    } elseif ($doCheat) {// tillägg 190520 fungerade ej; 190522 fungerar.
        $res =  "Cheat: The Number is " . $number;
        $_SESSION["res"] = $res;
    } elseif ($doInit) {
        return $app->response->redirect("guess/init");
    }

    return $app->response->redirect("guess/play");
});
