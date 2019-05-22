<?php
/**
 * Set the error reporting.
 */
error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors


/**
 * Default exception handler.
 */
set_exception_handler(function ($e) {
    echo "<p>Anax: Uncaught exception:</p>\n"
        . "<p>Line " . $e->getLine() . " in file " . $e->getFile() . "</p>\n"
        . "<p><code>" . get_class($e) . "</code></p>\n"
        . "<p>" . $e->getMessage() . "</p>\n"
        . "<p>Code: " . $e->getCode() . "</p>\n"
        . "<pre>" . $e->getTraceAsString() . "</pre>";
});
