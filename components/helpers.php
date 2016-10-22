<?php
/**
 * Function for not only printing the variable, but also file path and number of string of function call.
 * @param  mixed $data Some data.
 * @return void
 */
function pr($data)
{
    $backtrace = debug_backtrace()[0];
    $output    = "{$backtrace['file']}:{$backtrace['line']}\n" . print_r($data, true) . "\n\n";
    if (PHP_SAPI != 'cli') {
        $output = '<pre style="background-color: lightgrey;">' . $output . '</pre><br><br>';
    }
    echo $output;
}

/**
 * Generates UUID v4.
 * Source: http://php.net/manual/en/function.uniqid.php#94959
 * @return string UUID without hyphens.
 */
function uuid()
{
    return sprintf(
        '%04x%04x%04x%04x%04x%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,
        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
