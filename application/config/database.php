<?php

$connection = new PDO('mysql:host=127.0.0.1;dbname=test;port=3306', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
return $connection;