<?php
error_reporting(0);
    $mysqli = new mysqli('localhost', 'global', '0JwcZp5nMbLz48vv', 'ge_armhost_o');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
$mysqli->query("set names 'UTF8'");
?>