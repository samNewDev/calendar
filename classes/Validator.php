<?php

class Validator extends EventValidator {
    public function validates (array $data) {
        $this->validates($data);
        $this->validate('name', 'minLength', 30);
        return $this->errors;
    }
}