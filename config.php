<?php 
    $dbhost = "localhost";
    $dbname = "todoapp";
    $user = "root";
    $pass = "";
    $str = "bibshcdsk";
    global $database;
    $database = new PDO("mysql:host=$dbhost;dbname=$dbname",$user, $pass);
    try{
        $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

?>