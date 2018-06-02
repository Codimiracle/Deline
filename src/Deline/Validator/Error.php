<?php
namespace Deline\Validator;

class Error
{
    private $errors = array();

    public function reject($field, $message) {
        $errors[$field] = $message;
    }
   
    public function getErrors() {
        return $this->errors;
    }
}

