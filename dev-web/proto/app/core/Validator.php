<?php

interface ValidationInterface
{
    public function validate(array $data, array $rules): array;
    public function passes(): bool;
    public function getErrors(): array;
}

class Validator implements ValidationInterface
{
    protected array $errors = [];
    protected bool $passed = true;

    public function validate(array $data, array $rules): array
    {
        $this->errors = [];
        $this->passed = true;
        $validatedData = [];

        foreach ($rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);
            
            // Skip if field is not required and not present
            if (!in_array('required', $fieldRules) && (!isset($data[$field]) || $data[$field] === '')) {
                continue;
            }
            
            // Check required fields
            if (in_array('required', $fieldRules) && (!isset($data[$field]) || $data[$field] === '')) {
                $this->addError($field, 'Le champ ' . $field . ' est obligatoire');
                continue;
            }
            
            // If field exists, validate it against each rule
            if (isset($data[$field])) {
                $value = $data[$field];
                $validatedData[$field] = $value;
                
                foreach ($fieldRules as $rule) {
                    // Skip the required rule as it's already checked
                    if ($rule === 'required') {
                        continue;
                    }
                    
                    // Handle rules with parameters like max:255
                    if (strpos($rule, ':') !== false) {
                        list($ruleName, $parameter) = explode(':', $rule);
                        $this->validateRule($field, $value, $ruleName, $parameter);
                    } else {
                        $this->validateRule($field, $value, $rule);
                    }
                }
            }
        }

        return $validatedData;
    }

    /**
     * Validate a specific field with a rule
     */
    protected function validateRule(string $field, $value, string $rule, ?string $parameter = null): void
    {
        switch ($rule) {
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'Le champ ' . $field . ' doit être une adresse e-mail valide');
                }
                break;
            
            case 'numeric':
                if (!is_numeric($value)) {
                    $this->addError($field, 'Le champ ' . $field . ' doit être nombre');
                }
                break;
            
            case 'min':
                if (is_string($value) && strlen($value) < $parameter) {
                    $this->addError($field, 'Le champ ' . $field . ' doit avoir au moins ' . $parameter . ' caractères');
                } elseif (is_numeric($value) && $value < $parameter) {
                    $this->addError($field, 'Le champ ' . $field . ' doit être au moins ' . $parameter);
                }
                break;
            
            case 'max':
                if (is_string($value) && strlen($value) > $parameter) {
                    $this->addError($field, 'Le champ ' . $field . ' ne peut pas dépasser ' . $parameter . ' caractères');
                } elseif (is_numeric($value) && $value > $parameter) {
                    $this->addError($field, 'Le champ ' . $field . ' ne peut pas être supérieur à ' . $parameter);
                }
                break;
            
            // Add more validation rules as needed
        }
    }

    /**
     * Add an error message
     */
    protected function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
        $this->passed = false;
    }

    /**
     * Check if validation passed
     */
    public function passes(): bool
    {
        return $this->passed;
    }

    /**
     * Get validation errors
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}

