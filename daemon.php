<?php
/**
 * Created by PhpStorm.
 * User: osboxes
 * Date: 2/9/18
 * Time: 6:26 AM
 */

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

try {

    $redis = new Predis\Client();

}

catch (Exception $e) {

    die($e->getMessage());
}


function fibonacci($n)
{
    if ($n < 3) {
        return 1;
    }
    else {
        return fibonacci($n-1) + fibonacci($n-2);
    }
}






while(1){
    $list = $redis->keys("*");
    sort($list);

    foreach ($list as $key)
    {
        if(strpos($key, "id") !== false){
            $id = $key;
            $num = explode('-', $key)[1];
            if($redis->hget("{$id}", "result") == 0 && $redis->hget("{$id}", "result") == 0) {
                $redis->hset("{$id}", "status", 1);
                $redis->hset("{$id}", "result", fibonacci($num));
                echo $redis->hget("{$id}", "result"),"\n";
                break;
            }
            else {
                echo "Работы нет. \n";
                sleep(1);
            }
        }
    }
}