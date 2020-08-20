<?php

function debugging(...$vars){
    foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';die();
    }
}

function h(?string $value) : string {
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}