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



?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Число Фибоначи</title>
    </head>
    <body>
    <?php if(isset($_POST['num'])){
        $num = $_POST['num'];
    }
    ?>
        <form action="" method="post">
            <?php if(!isset($num)){
                echo "<h2>Введите ваше число</h2>";
                echo "<input type='number' placeholder='число' name='num'>";
                echo "<input type='submit' value='go'>";
            } else {
                $taskJson = json_encode(array("num" => $num, "status" => 0, "result" => NULL));
                $id = $_SESSION['id'] . "-" . $num;
                $redis->set("{$id}", $taskJson);
                header("Location: result.php?num={$num}");
            }
            ?>
        </form>
    </body>
</html>