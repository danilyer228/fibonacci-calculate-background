<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

try {
    $redis = new Predis\Client();

}

catch (Exception $e) {

    die($e->getMessage());
}

while(1) {
    $list = $redis->keys("*");
    sort($list);

    foreach ($list as $key) {
        $taskJson = json_decode($redis->get($key), true);
        if($taskJson['result'] !== NULL) {
            $redis->del($key);
        }
    }
    echo "Редис очищен";
    sleep(300);
}