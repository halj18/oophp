<?php
namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Guess my number (SESSION)</h1>
<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

<form method="post">
    <?php if (($tries > 0) && ((isset($res) && ($res != "Correct.")) || !isset($res))) : ?>
        <input type="text" name ="guess">
        <input type="submit" name="doGuess" value="Make a guess">
        <input type="submit" name="doCheat" value="Cheat">
    <?php endif; ?>
    <input type="submit" name="doInit" value="Start from beginning">
</form>

<?php if ($res) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
    <!--<p>Your guess <= //$guess ?> is <b><=// $game->makeGuess((int) $guess) ?></b></p>-->
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number() ?>.</p>
<?php endif; ?>

<!-- 0428 -->
 <!--<?php //if ($res) : ?>   dessa rader tidigare för $message-variablen -->
    <!-- <? //$res ?></p> -->
<!-- <?php //endif; ?> -->
