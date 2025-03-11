<?php
require 'includes/validation-methods.php';

function validateData(array $reauestDatas, array $rules): array
{
    $errors = [];
    $datas = $reauestDatas;
    $validationResult = [];
    foreach ($rules as $name => $rule) {
        $value = $datas[$name];
        $valueCleaned = htmlspecialchars(strip_tags(trim($value)));
        $item  = $rule($name, $valueCleaned);
        if (!$item['isValidated']) {
            $errors[$name] =  $item['message'];
        } else {
            $validationResult[$name] = $item['value'];
        }
    }
    $hasError = count($errors) > 0;
    $resultKey = $hasError ? 'errors' : 'datas';
    return [
        'hasError' =>  $hasError,
        "$resultKey" => $hasError ? $errors :  $validationResult,
    ];
}
