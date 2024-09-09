<?php
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';

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
            if ($row['active']=="1") {
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
                $text_message = "Ваш адрес электронной почты подтвержден.";
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/login_form.php';
            }
            else {
                // Проверяем токен
                if ($token == $row['reg_token']) {
                    $text_message = "Ваша электронная почта подтверждёна.<br>Остался последний шаг:";
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/new_password.php';
                    EmailMessageHelloOlga('', $email, 'Flent. Будем знакомы 👋🏻');
                    //siteStatistics('EmailConfirm', 'Успешно'); 
                    //$magiStat = new magiStat(); $magiStat->insertData('EmailConfirm', '', 'Успешно', 0);

                } else {
                    $error_h1 = "Ошибка подтверждения email";
                    $text_message = "Убедитесь, что вы перешли по правильной ссылке.<br>Если проблема сохраняется, свяжитесь с нами для помощи.";
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/error_message.php';
                    //siteStatistics('EmailConfirm', 'Error token'); 
                    //$magiStat = new magiStat(); $magiStat->insertData('EmailConfirmError', '', 'Error token', 0);
                }
        }
        } else {
            $error_h1 = "Ошибка подтверждения email";
            $text_message = "Убедитесь, что вы перешли по правильной ссылке.<br>Если проблема сохраняется, свяжитесь с нами для помощи.";
            require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/error_message.php';
            //siteStatistics('EmailConfirm', 'Error email'); 
            //$magiStat = new magiStat(); $magiStat->insertData('EmailConfirmError', '', 'Error email', 0);
        }
    } catch(PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}



$page_title = $config['project_name'].". Подтверждение email";

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  
?>