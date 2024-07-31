<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/index.php';

class BaseSelect
{
    protected static function resultsBuilder($results, $options = [])
    {
        $resultOptions = '';
        // print_r($results);
        if (count($results) < 1) {
            return $resultOptions;
        }

        // if (empty($options['noFirstValue']) || !$options['noFirstValue'])
        //     $resultOptions .= '<option value="">전체보기</option>';

        foreach ($results as $result) {
            $resultOptions .= '<option value="' . $result[$options['optionValue']] . '">';
            $resultOptions .= $result[$options['optionLabel']];
            $resultOptions .= '</option>';
        }

        return $resultOptions;
    }

    protected static function resultsFirstSelectedBuilder($results, $options = [])
    {
        $resultOptions = '';

        if (count($results) < 1) {
            return $resultOptions;
        }

        if (empty($options['noFirstValue']) || !$options['noFirstValue'])
            $resultOptions .= '<option value="">선택해주세요.</option>';

        if (!empty($options['selected']) || $options['selected']) {
            $keyValue = $options['selected'];
        }else {
            $keyValue = 0;
        }

        foreach ($results as $key => $result) {
            if($key == $keyValue) {
                $resultOptions .= '<option value="' . $result[$options['optionValue']] . '" selected>';
                $resultOptions .= $result[$options['optionLabel']];
                $resultOptions .= '</option>';
            } else {
                $resultOptions .= '<option value="' . $result[$options['optionValue']] . '">';
                $resultOptions .= $result[$options['optionLabel']];
                $resultOptions .= '</option>';
            }
        }

        return $resultOptions;
    }
}