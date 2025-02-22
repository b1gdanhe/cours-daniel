<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
function validate($value)
{
    if (!isset($value)) {
        return false;
    } else {
        $valueCleaned = htmlspecialchars(strip_tags(trim($value)));
        return empty($valueCleaned) ? false : $valueCleaned;
    }
}
