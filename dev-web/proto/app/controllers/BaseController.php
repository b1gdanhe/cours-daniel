<?php

class BaseController
{
    protected $db;

    protected ValidationInterface $validator;

    public function __construct()
    {
        $dbConfig = getConfig('db');
        $this->validator = new Validator();
        $this->db = Database::getInstance($dbConfig)->getConnection();
    }

    protected function render(string $view, array $data = [])
    {
        page($view, $data);
    }

    public function validate(array $data, array $rules)
    {
        $validatedData = $this->validator->validate($data, $rules);

        if (!$this->validator->passes()) {
            return false;
        }

        return $validatedData;
    }


    public function getValidationErrors(): array
    {
        return $this->validator->getErrors();
    }
}
