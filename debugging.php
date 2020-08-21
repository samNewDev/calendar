<?php

function debugging(...$vars){
    foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';//die();
    }
}

function h(?string $value) : string {
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}

function render($params = []){
    extract($params);
    include("../views/header.php");
}

function findTitle() : string{
    $scriptFileArray = explode('/', $_SERVER['SCRIPT_NAME']);
    $title = explode('.', $scriptFileArray[count($scriptFileArray) - 1]);
    if($title[0] === 'event'){
        return ucfirst($title[0]);
    }else {
        return '';
    }
}