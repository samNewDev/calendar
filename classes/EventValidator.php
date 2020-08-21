<?php

class EventValidator {

    private $errors;
    private $data;

    /**
     * Returns true or errors collected from the methods "validate() and minLength()"
     * @param  array $post : the POST array
     * @return array|bool
    */

    public function validates (array $post) {
        $this->data = $post;
        $this->validate('name', 'minLength', 5);
        return $this->errors;
    }

    /**
     * Calls the required method
     * @param string $field : 
     */
    public function validate(string $field, string $method, ...$params) {
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "The field $field needs to be filled";
        }
        else {
            call_user_func([$this, $method], $field, ...$params);
        }
    }

    public function minLength(string $field, int $length) {
        if (mb_strlen($field) < $length) {
            $this->errors[$field] = "5 char min required for the field $field";
        }
    }
}
