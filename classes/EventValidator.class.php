<?php

class EventValidator {

    private $errors;
    protected $data;

    /**
     * Returns errors collected from the methods "validate() and minLength()"
     * @param  array $data
     * @return array|bool
    */
    public function validates(array $data) {
        $this->errors = [];
        $this->$data = $data;
        return $errors;
    }

    public function validate(string $field, string $method, int $length) {
        if (!isset($field)) {
            $this->errors[$field] = "The field $field needs to be filled";
        }
        else {
            call_user_func([$this, $method], $field, ...$method);
        }
    }

    public function minLength(string $field, int $length) {
        if ($field < $length) {
            $this->errors[$field] = "3 char min required for the field $field";
        }
    }
}