<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
    $token = filter_var($_POST['token'], FILTER_SANITIZE_STRING);

    try {
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if ($row['active']=="0") {
                $error_h1 = "Ошибка";
                $text_message = "Похоже, что вы уже использовали эту ссылку и уже придумали пароль ранее.";
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/error_message.php';
                EmailMessageHelloOlga('', $email, 'Flent. Будем знакомы 👋🏻');
                //$magiStat = new magiStat(); $magiStat->insertData('NewPasswordError', '', 'Вы уже использовали эту ссылку и уже придумали пароль ранее. '.$email.'.', 0, $email);
            }
            if ($token == $row['reg_token']) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET password = :password, reg_token = 0, active = 1 WHERE email = :email";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();

                EmailMessageHelloOlga('', $email, 'Flent. Будем знакомы 👋🏻');

                setAuthCookie($email,$row['ID']);
                //$magiStat = new magiStat(); $magiStat->insertData('NewPasswordSuccess', '', 'Успешно', 0, $email);
                header("Location: /"); // Перенаправляем на другую страницу после успешной аутентификации
                exit();
            }
        }
    } catch(PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

?>


