<?php
function connect() {
    return new PDO('mysql:host=localhost;dbname=soschr', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}


?>
