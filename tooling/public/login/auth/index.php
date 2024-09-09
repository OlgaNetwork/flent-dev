<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  
    try {
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);       
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if (password_verify($password, $row['password'])) {
                setAuthCookie($email);
                header("Location: /tools/"); // Перенаправляем на другую страницу после успешной аутентификации
                exit();
            } else {
                echo "Неверный пароль. Попробуйте снова.";
            }
        } else {
            echo "Пользователь с указанным email не найден.";
        }
    } catch(PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

?>
