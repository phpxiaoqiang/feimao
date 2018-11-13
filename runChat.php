<?php
ini_set('display_errors','on');
use Workerman\Worker;

if(!extension_loaded('pcntl')){
    exit("Please install pcntl extension.");
}

if(!extension_loaded('posix')){
    exit("Please install posix extension.");
}

define('GLOBAL_START',1);

require_once __DIR__ . "/vendor/autoload.php";

foreach(glob(__DIR__."/Chat/start*.php") as $start_file){
    require_once $start_file;
}

Worker::runAll();
