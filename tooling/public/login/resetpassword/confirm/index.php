<?php
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

$page_title = "Придумайте пароль";
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
//$magiStat = new magiStat(); $magiStat->insertData('ResetpasswordEmailConfirm', '', 'Page', 1);

if (isset($_GET['t']) && isset($_GET['e'])) {
    $email = filter_var($_GET['e'], FILTER_SANITIZE_EMAIL);
    $token = filter_var($_GET['t'], FILTER_SANITIZE_STRING);

    try {
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {                
                if ($token == $row['reg_token']) { // Проверяем токен
                    $text_message = "";
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/new_password.php';
                    //siteStatistics('EmailConfirm', 'Успешно'); 
                    //$magiStat = new magiStat(); $magiStat->insertData('ResetpasswordEmailConfirm', '', 'Успешно', 0, $email);
                } else {
                    $error_h1 = "Ошибка";
                    $error_button_url = "/login/resetpassword/?email=".$email;
                    $error_button_text = "Восстановить пароль";
                    $text_message = "Убедитесь, что вы перешли по правильной ссылке.<br>Возможно, ваша ссылка устарела, используйте ссылку из последнего письма.<br><br>Если требуется, попробуйте сделать повторное <a href='/login/resetpassword/?email=".$email."'><u>восстановление пароля</u></a>.";
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/error_message.php';
                    //siteStatistics('EmailConfirm', 'Error token'); 
                    //$magiStat = new magiStat(); $magiStat->insertData('ResetpasswordEmailConfirm', '', 'Error token', 0, $email);
                }
            }
    } catch(PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}


$page_title = $config['project_name'].". Подтверждение email";

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  
?>