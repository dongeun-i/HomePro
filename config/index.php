<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/config/Autoload.php';
require 'AutoLoad.php';

// session_start();

Autoload::loadRun();

date_default_timezone_set('Asia/Seoul');
// header('Content-Type: text/html; charset=UTF-8');

$db = new Database();

