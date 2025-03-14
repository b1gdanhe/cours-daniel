<?php
require BASE_PATH . 'includes/validation-methods.php';

function validateData(array $reauestDatas, array $columnsRules): array
{
    $errors = [];
    $datas = $reauestDatas;
    $validationResult = [];
    foreach ($columnsRules as $column => $columnRules) {
        $value = $datas[$column];
        $valueCleaned = htmlspecialchars(strip_tags(trim($value)));
        formatRules($columnRules);
        // $item  = $rule($column, $valueCleaned);


        // if (!$item['isValidated']) {
        //     $errors[$column] =  $item['message'];
        // } else {
        //     $validationResult[$column] = $item['value'];
        // }
    }
    $hasError = count($errors) > 0;
    $resultKey = $hasError ? 'errors' : 'datas';
    return [
        'hasError' =>  $hasError,
        "$resultKey" => $hasError ? $errors :  $validationResult,
    ];
}

function formatRules(string|array $columnRules)
{
    $rules  =  is_array($columnRules) ? $columnRules : explode("|", $columnRules);
    foreach ($rules as  $rule) {
        $ruleWithParams = explode(":", $rule);
        $ruleName = explode(":", $rule)[0];
        $params = count($ruleWithParams) === 2 ?  explode(",", $ruleWithParams[1]) : [];
        // dd($ruleName, false);
        $dd = extract($params, EXTR_PREFIX_INVALID, "rule_params");
        dd($rule_params_0, false);
    }
}
function recursiveValidation($fn, $validationNumber)
{
    // if (!$item['isValidated']) {
    //     $errors[$column] =  $item['message'];
    // } else {
    //     $validationResult[$column] = $item['value'];
    // }
}
