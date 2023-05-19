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

const APP_BASE_PATH = 'http://minicrm.local:6080/';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '12345';
const DB_NAME = 'minicrm';
const START_ROLE = '1';
