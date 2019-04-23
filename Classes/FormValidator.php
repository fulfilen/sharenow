<?php

class FormValidator 
{
    private $fieldName;
    private $fieldErrors;
    protected $db;

    public function construct()
    {
        $this->db = Database::instance();
    }

    public function addField(string $fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    public function validate(array $rules ) 
    {

        $fieldVal = $_POST[$this->fieldName];

        foreach ($rules as $ruleKey => $ruleVal) {

            switch ($ruleKey) {
                case 'required':
                    if ( $ruleKey === 'required' && empty($fieldVal)) {
                        
                        $this->logFieldErrors(sprintf('%s field is required', $this->fieldName));
                    }
                break;

                case 'min':
                    if (! empty($fieldVal) && strlen($fieldVal) < $ruleVal) {

                        $this->logFieldErrors( sprintf('%s field too short. Minimum length is %d', $this->fieldName, $ruleVal));
                    }
                break;

                case 'matches':
                    if ($fieldVal != $_POST[$ruleVal]) {

                        $this->logFieldErrors( sprintf('%s field must match %s field', $this->fieldName, $ruleVal));
                    }
                break;

                case 'unique':
                    if (Database::instance()->get($ruleVal, [$this->fieldName, '=', $fieldVal])->rowCount()) {
                        $this->logFieldErrors( sprintf('%s already exists, choose another', $this->fieldName));
                    } else {

                    }
                break;
                
                default:
                    # code...
                break;
            }
        }
    }

    public function logFieldErrors($ErrorMessage)
    {

       return $this->fieldErrors[$this->fieldName] = $ErrorMessage;

    }


    public function showFieldError($fieldName) 
    {
        if (isset($this->fieldErrors[$fieldName])) {

            echo ucwords(str_replace('_', ' ', $this->fieldErrors[$fieldName]));
        }
        return null;
    }

    public function passed() 
    {
        return (count($this->fieldErrors) == 0) ? true : false ;
    }

}
?>