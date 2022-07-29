<?php

class Utility {

    public static function generateRandomCharacters ($length, $uppercase = 1, $lowercase = 0, $numbers = 1, $extraCharacters = '', $unusedCharacters = '') {
        if ( $length < 1 )
            return '';

        $upperCaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowerCaseLetters = 'abcdefghijklmnopqrstuvwxyz';
        $numericCharacters = '0123456789';
        $dataset = $extraCharacters;

        if ( $uppercase )
            $dataset .= $upperCaseLetters;

        if ( $lowercase )
            $dataset .= $lowerCaseLetters;

        if ( $numbers )
            $dataset .= $numericCharacters;

        $dataset = str_replace(str_split($unusedCharacters, 1), "", $dataset);

        if ( strlen($dataset) < 1 )
            return '';

        $text = '';
        $datasetLength = strlen($dataset);
        $textLength = 0;

        while ( $textLength < $length ) {
            $text .= $dataset[ rand(0, $datasetLength - 1) ];
            $textLength++;

        }

        return $text;
    }
}