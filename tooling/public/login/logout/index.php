<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

//siteStatistics('Logout',''); 
//$magiStat = new magiStat(); $magiStat->insertData('Logout', '', '', 0);

setcookie('auth', '', time() - 3600, '/'); // Устанавливаем куку с отрицательным сроком действия (1 час назад) и пустым значением

header("Location: https://flent.ru");
exit();
?>
