<?php

include 'dbcon.php';
$pdo=pdo_connect();
$page=isset($_GET['page']) && file_exists($_GET['page'] . '.php')? $_GET['page']: 'userdashboard.php';
include $page. '.php';
?>