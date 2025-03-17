<?php
require base_path('includes/validation-methods.php');


function validateData(array $requestData, array $columnsRules): array
{
    $errors = [];
    $validationResult = [];

    foreach ($columnsRules as $column => $columnRules) {
        // Skip validation if the column doesn't exist in the request data
        if (!isset($requestData[$column])) {
            $errors[$column] = "Le champ $column est requis";
            continue;
        }

        $value = $requestData[$column];
        $valueCleaned = htmlspecialchars(strip_tags(trim($value)));

        // Process the rules for this column
        $rulesList = parseRules($columnRules);
        foreach ($rulesList as $ruleData) {
            $ruleName = $ruleData['name'];
            $ruleParams = $ruleData['params'];

            // Skip if the rule doesn't exist as a function
            if ($ruleName == '') {
                $validationResult[$column] = $valueCleaned;
                continue;
            }
            if (!function_exists($ruleName)) {
                continue;
            }

            // Call the validation function with the appropriate parameters
            $result = callValidationFunction($ruleName, $column, $valueCleaned, $ruleParams);

            if (!$result['isValidated']) {
                $errors[$column] = $result['message'];
                break; // Stop on first error for this column
            } else {
                $validationResult[$column] = $result['value'];
            }
        }
    }

    $hasError = count($errors) > 0;
    $resultKey = $hasError ? 'errors' : 'datas';

    return [
        'hasError' => $hasError,
        $resultKey => $hasError ? $errors : $validationResult,
    ];
}


function parseRules(string|array $columnRules): array
{
    $rules = is_array($columnRules) ? $columnRules : explode("|", $columnRules);
    $parsedRules = [];

    foreach ($rules as $rule) {
        // Check if the rule is already fully parsed (e.g. from conditional statements)
        if (is_string($rule)) {
            $ruleWithParams = explode(":", $rule, 2); // Limit to 2 to handle complex parameters
            $ruleName = $ruleWithParams[0];
            $params = [];

            if (count($ruleWithParams) === 2) {
                // Handle parameters that might contain commas inside values (like exists:table,column,value)
                $params = explode(",", $ruleWithParams[1]);
            }

            $parsedRules[] = [
                'name' => $ruleName,
                'params' => $params
            ];
        } else if (is_array($rule) && isset($rule['name'])) {
            // Rule is already in the right format
            $parsedRules[] = $rule;
        }
    }

    return $parsedRules;
}


function callValidationFunction(string $ruleName, string $column, $value, array $params = []): array
{
    switch ($ruleName) {
        case 'string':
            $min = $params[0] ?? 1;
            $max = isset($params[1])  ? (int)$params[1] : INF;
            return string($column, $value, (int)$min, $max);

        case 'int':
            $min = $params[0] ?? 1;
            $max = isset($params[1])  ? (int)$params[1] : INF;
            return int($column, $value, (int)$min, $max);

        case 'email':
            return email($column, $value);

        case 'exists':
            $table = $params[0] ?? '';
            $tableColumn = $params[1];
            $checkValue = $params[2]; // Allow explicitly specifying the value to check
            return exists($table, $tableColumn, $checkValue);

        case 'unique':
            $table = $params[0] ?? '';
            $tableColumn = $params[1] ?? $column;
            $checkValue = $params[2] ?? $value; // Allow explicitly specifying the value to check
            return unique($table, $tableColumn, $checkValue);

        default:
            // If the rule is a custom function, call it directly
            if (function_exists($ruleName)) {
                return $ruleName($column, $value, ...$params);
            }

            // Default validation (simple not empty check)
            $validValue = validate($value);
            return returnValidationResult($validValue !== false, $validValue);
    }
}
