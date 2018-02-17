<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-2
 * Time: 下午4:13
 */

namespace CAstore\Verifier;


abstract class AbstractVerifier implements Verifier
{
    private $hit = -1;
    private $hittedField = null;
    private $codes = array();

    private function check($field) {
        if (isset($_POST[$field]) && ($value = $_POST[$field]) != "") {
            if (preg_match($this->getPattern($field), $value)) {
                return Verifier::RESULT_OK;
            } else {
                return Verifier::RESULT_UNRECOGNIZED;
            }
        } else {
            return Verifier::RESULT_EMPTY;
        }
    }

    /**
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
        $this->hit = -1;
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
        if ($code != Verifier::RESULT_OK && $this->hit != 1) {
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
            case Verifier::RESULT_OK:
                return $this->getPassedMessage($field);
            case Verifier::RESULT_EMPTY:
                return $this->getEmptyMessage($field);
            case Verifier::RESULT_UNRECOGNIZED:
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

