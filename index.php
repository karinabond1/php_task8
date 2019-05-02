<?php
require 'libs/phpQuery.php';
require 'libs/Parser.php';


$input1 = $_POST['input'];
if (isset($_POST['btn'])) {
    $input = str_replace(" ","+",$input1);
    $url = 'https://www.google.com/search?q=' . $input;
    $start = 0;
    $end = 1;
    $parse = new Parser($url,$start,$end);
    $parseResult = $parse->parser($url,$start,$end);
} else {
    $parseResult = array();
}

include_once 'templates/index.php';
?>