<h1>Guess my number (SESSION)</h1>
<p>Guess a number between 1 and 100, you have <?= $tries ?> left.</p>
<form method="post">

    <?php if (($tries > 0) && ((isset($res) && ($res != "Correct.")) || !isset($res))) : ?>
        <input type="text" name ="guess">
        <input type="submit" name="doGuess" value="Make a guess">
        <input type="submit" name="doCheat" value="Cheat">
    <?php endif; ?>
    <input type="submit" name="doInit" value="Start from beginning">

</form>

<?php if (($doGuess) && isset($res)) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
    <!--<p>Your guess <= //$guess ?> is <b><=// $game->makeGuess((int) $guess) ?></b></p>-->
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $game->number() ?>.</p>
<?php endif; ?>
<!-- 0428 -->
<?php if ($message) : ?>
    <p><?= $message ?></p>
<?php endif; ?>

<!--
<pre>
< // var_dump($_POST) >
