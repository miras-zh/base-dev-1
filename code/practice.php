<?php

//preg_match("@^(?:http://)?([^/]+)@i","http://php.net/index.html", $matches);
//$host = $matches[1];
//
//preg_match("/[^.]+\.[^.]+$/",$host, $matches);
//echo $matches[0];

//    "<div class='container'><span>TARGET</span><div class='info'>INFO</div></div>",

if(
    preg_match("/^#([a-z.-]{3})$/", "#www",$matches)
){
    echo PHP_EOL . ">";
    print_r($matches);
}else{
    echo PHP_EOL . 'NO' . PHP_EOL;
}








//1 - example
//// /i регистро не зависисые ("/php/i")
//// \b граница слова - ограничим поиск  ("/\bphp\b/i")
//
//if(preg_match('/\bphp\b/i','is to d phP lang')){
//    echo PHP_EOL;
//    echo 'success'. PHP_EOL;
//}else{
//    echo PHP_EOL;
//    echo 'no'. PHP_EOL;
//}
