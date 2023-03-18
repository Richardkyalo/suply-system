<?php

function pdo_connect(){

$server="localhost";
$dbname="user";
$user="root";
$password="";


try{
    return new PDO('mysqli:host' . $server.';dbname' .$dbname . ';charset=utf8', $user,$password);
}catch(PDOException $exception){
    exit('failed to connect');
  }
}
?>