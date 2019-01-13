<?php

/**
 * oneMoreErrorHandler
 *
 * @param int $number Number of error
 * @param string $message Error message
 * @param string $file Filename that the error was raised in
 * @param int $line Number of line
 */
function oneMoreErrorHandler($number, $message, $file, $line)
{
    throw new oneMoreException($number, $message, $file, $line);
}

/**
 * Set error handler
 */
//set_error_handler('oneMoreErrorHandler');
