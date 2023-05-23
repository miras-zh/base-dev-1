<?php

function tlog($str){
    echo '<pre>';
        print_r($str);
    echo '</pre>';
}

function tlog_exit($str){
    echo '<pre>';
    print_r($str);
    echo '</pre>';
    exit();
}

if ($_SERVER['HTTP_HOST'] === 'minicrm.local:6080') {
    define("APP_BASE_PATH", 'http://minicrm.local:6080/');
    define("DB_HOST", 'localhost');
    define("DB_USER", 'root');
    define("DB_PASS", '12345');
    define("DB_NAME", 'minicrm');
    define("START_ROLE", 1);
} else {
    define("DB_HOST", 'srv-pleskdb19.ps.kz');
    define("DB_USER", 'kazcickz_miko');
    define("DB_PASS", '999887Ww+');
    define("DB_NAME", 'kazcickz_minicrm');
    define("START_ROLE", 1);
}

