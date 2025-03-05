<?php

const ALLOW_FILE_TYPES = ['application/pdf', 'image/png', 'image/jpg', 'image/jpeg'];


function dd($value)
{
    echo '<pre  style="background-color: black; color: lightgreen; padding: 10px; "> ';
    var_dump($value);
    echo '</pre>';
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

function validateFile($file)
{
    if ($file['error'] || !in_array($file['type'], ALLOW_FILE_TYPES)) {
        return false;
    }
    return $file;
}

function storeFile($currentLocation, $destination = '')
{
    return move_uploaded_file(from: $currentLocation, to: $destination);
}


