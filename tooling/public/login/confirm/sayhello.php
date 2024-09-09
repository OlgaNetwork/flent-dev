<?php
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';

if (isset($_GET['t']) && isset($_GET['e'])) {
    $email = filter_var($_GET['e'], FILTER_SANITIZE_EMAIL);
    $token = filter_var($_GET['t'], FILTER_SANITIZE_STRING);

    echo $email;

    EmailMessageHelloOlga('', $email, 'Magikey. Будем знакомы 👋🏻');
}



$page_title = $config['project_name'].". Подтверждение email";

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  
?>