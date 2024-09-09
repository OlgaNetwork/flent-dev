<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Подключение к базе данных
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        // Устанавливаем режим обработки ошибок в исключения
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL-запрос для получения данных пользователя по email
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Проверяем пароль
            if (password_verify($password, $row['password'])) {
                // Пароль верный, аутентификация успешна
                setAuthCookie($email);
                //$_SESSION['user_id'] = $row['ID'];
                //$_SESSION['email'] = $email;
                // Другие данные о пользователе, которые вы хотите сохранить в сессии

                $username = checkAuthCookie();
                echo $username;

                //header("Location: /tools/"); // Перенаправляем на другую страницу после успешной аутентификации
                //exit();
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



/*

// Генерация и сохранение хеша в сессию
function generateAndSaveHash() {
    $hash = md5(uniqid(rand(), true)); // Пример генерации хеша, замените его на более безопасный метод при необходимости

    $_SESSION['hash'] = $hash;

    return $hash;
}

// Проверка хеша
function isHashValid($hash) {
    return isset($_SESSION['hash']) && $_SESSION['hash'] === $hash;
}

// Использование функции для генерации и сохранения хеша
$generatedHash = generateAndSaveHash();

// Проверка хеша на других страницах
if (isHashValid($generatedHash)) {
    echo "Хеш верный. Можно продолжить.";
} else {
    echo "Хеш неверный. Доступ запрещен.";
}
*/

?>
