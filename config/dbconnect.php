<?php

    $dbhost = "localhost";
    $dbuser = "user3307_stadmin";
    $dbpassword = "fruitsandvegetables";
    $dbname = "user3307_fruits_vegetables_store";

    $connect = new \PDO(
        'mysql:host='. $dbhost .';
        dbname='. $dbname .';
        charset=utf8;',
        $dbuser,
        $dbpassword
    );
    $connect->exec('SET NAME UTF8');

    if(!$connect){
        echo "Не удалось подключиться к базе данных";
    }
    
?>
