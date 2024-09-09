<?
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

$userEmail = checkAuthCookie()[0];

header("Location: /index.html");
?>