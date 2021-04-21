<?php

/**
 * Redirects to an order.
 * @param string the order.
 */
function redirect($url)
{
    header('Location: ' . ROOT . $url);
}

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
