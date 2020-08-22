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
        $this->validate('start', 'checkStartEndTime', 'end');
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
            return false;
        }else {
            return true;
        }
    }

    public function checkStartEndTime(string $startTime, string $endTime){
        if(($this->time($startTime) && $this->time($endTime)) !== true){
            return false;
        }else {
            $start = DateTime::createFromFormat('H:i', $this->data[$startTime]);
            $end = DateTime::createFromFormat('H:i', $this->data[$endTime]);
            if ($start->getTimestamp() > $end->getTimestamp()) {
                $this->errors['start'] = "Time is not valid";
                return false;
            }
        }
    }
}
