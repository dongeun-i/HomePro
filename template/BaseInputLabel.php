<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/index.php';

class BaseInputLabel
{
    protected static function resultsBuilder($results, $options = [], $name='',$required = false) {
        $resultOptions = '';
        if (count($results) < 1) {
            return $resultOptions;
        }
    
        $req = $required ? 'required' : '';
        foreach ($results as $result) {
            $value = $result[$options['optionValue']];
            $label = $result[$options['optionLabel']];
            $resultOptions .= "<label><input type='radio' name='$name' value='$value' $req>$label</label>";
        }
    
        return $resultOptions;
    }
}