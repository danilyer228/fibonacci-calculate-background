<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

session_start();

if(!isset($_SESSION['id'])){
    $_SESSION['id'] = "id" . md5(uniqid(rand(), true));

}

try {
    $redis = new Predis\Client();

}

catch (Exception $e) {

    die($e->getMessage());
}

$list = $redis->keys("*");

sort($list);

foreach ($list as $key) {
    $partOfKey = explode("-", $key)[1];
    if($partOfKey == $_GET['num']){
        $id = $key;
    }
}

echo "<h2>Результат({$_GET['num']})</h2>";
$result = $redis->hget("{$id}", "result");
if($result !== "0"){
    echo $result;
} else {
    echo "Ждите.";
}

?>