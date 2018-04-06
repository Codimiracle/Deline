<?php
namespace Deline\Validator;

abstract class AbstractValidator implements Validator
{

    private $hit = - 1;

    private $hittedField = null;

    private $codes = array();

    private function check($field)
    {
        if (isset($_POST[$field]) && ($value = $_POST[$field]) != "") {
            if (preg_match($this->getPattern($field), $value)) {
                return Validator::RESULT_OK;
            } else {
                return Validator::RESULT_UNRECOGNIZED;
            }
        } else {
            return Validator::RESULT_EMPTY;
        }
    }

    /**
     *
     * @return array
     */
    public abstract function getFields();

    public abstract function getPattern($field);

    public abstract function getPassedMessage($field);

    public abstract function getEmptyMessage($field);

    public abstract function getUnrecognizedMessage($field);

    public function isValidity()
    {
        return $this->hit == 0;
    }

    public function verifyAll()
    {
        $this->hit = - 1;
        foreach ($this->getFields() as $field) {
            $this->verify($field);
        }
        if (is_null($this->hittedField)) {
            $this->hit = 0;
        }
    }

    public function verify($field)
    {
        $code = $this->check($field);
        $this->codes[$field] = $code;
        if ($code != Validator::RESULT_OK && $this->hit != 1) {
            $this->hit = 1;
            $this->hittedField = $field;
            return false;
        }
        return true;
    }

    public function getValidationCode($field)
    {
        return $this->codes[$field];
    }

    public function getValidationMessage($field)
    {
        $code = $this->codes[$field];
        switch ($code) {
            case Validator::RESULT_OK:
                return $this->getPassedMessage($field);
            case Validator::RESULT_EMPTY:
                return $this->getEmptyMessage($field);
            case Validator::RESULT_UNRECOGNIZED:
                return $this->getUnrecognizedMessage($field);
            default:
                return "Unkown verified code.";
        }
    }

    public function getResultCode()
    {
        return $this->getValidationCode($this->hittedField);
    }

    public function getResultMessage()
    {
        return $this->getValidationMessage($this->hittedField);
    }
}

