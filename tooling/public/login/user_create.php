<?php

exit();







// Параметры подключения к базе данных
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';


try {
    // Подключение к базе данных
    $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
    // Устанавливаем режим обработки ошибок в исключения
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Генерируем пароль
    //$password = generatePassword();
    $password = "Olga3210";

    // Хешируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Текущая дата
    $data_reg = date('Y-m-d');

    // SQL-запрос для вставки нового пользователя
    $sql = "INSERT INTO users (login, email, password, active, token_counter, data_reg, data_session, session_counter, session_time_counter, tariff)
            VALUES ('новый_логин', 'olga@aprilstudio.ru', :hashed_password, 1, 0, :data_reg, NULL, 0, 0, 0)";

    // Подготавливаем запрос
    $stmt = $conn->prepare($sql);

    // Биндим параметры
    $stmt->bindParam(':hashed_password', $hashed_password);
    $stmt->bindParam(':data_reg', $data_reg);

    // Выполняем запрос
    $stmt->execute();

    echo "Новый пользователь успешно создан.";

} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

// Функция для генерации случайного пароля
function generatePassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    echo $password;
    return $password;
}
?>
