<?php

class EventValidator {

    private $errors;
    private $data;

    /**
     * Returns true or errors collected from the method "validate()
     * @param  array $post : the POST array
     * @return array|bool
    */

    public function validates (array $post) {
        $this->erros = [];
        $this->data = $post;
        $this->validate('name', 'minLength', 5);
        $this->validate('date', 'date');
        $this->validate('start', 'time', 5);
        $this->validate('end', 'time', 5);
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
        $fieldLength = mb_strlen($this->data[$field]);
        if (mb_strlen($this->data[$field]) < $length) {
            $this->errors[$field] = "$length char min required for the field <strong>$field</strong>";
        }   
    }

    public function date(string $field){
        if(DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false){
            $this->errors[$field] = "Time is not valid";
        }
    }

    public function time(string $field){
        if(DateTime::createFromFormat('H:i', $this->data[$field]) === false){
            $this->errors[$field] = "Time is not valid";
        }
    }
}
