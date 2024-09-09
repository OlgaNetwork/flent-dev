<?php
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

$text = "Что-то пошло не так.<br>Попробуйте <a href='/login/request/'><u>вернуться на шаг</u></a> назад и введите заново";
$title = "Ошибка";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];

    try {   
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $data_reg = date('Y-m-d H:i:s');

        $sql = "INSERT INTO request (name, email, phone, data_reg)
                VALUES (:name, :email, :phone, :data_reg)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':data_reg', $data_reg);

        $stmt->execute();

        $title = "Ваша заявка отправлена";
        $text = "Наш менеджер свяжется с вами.<br><br>Пока ждёте можете подписаться на наш канал в Телеграм: <a href='https://t.me/ModaGPT'><u>@ModaGPT</u></a>";

        siteStatistics('Request for registration. Form',"Заявка на регистрацию: ".$name."\nEmail: ".$email."\nPhone: ".$phone); 

        $user_ip = $_SERVER['REMOTE_ADDR']; // Получаем IP-адрес пользователя
        $message = "Новая заявка на регистрацию: \n".$name."\nEmail: ".$email."\nPhone: ".$phone."\n\nIP: ".$user_ip."\nhttps://modagpt.ru/logs/?userIp=".$user_ip;
        TelegramMessage($message, $config['telegram_token'], $config['telegram_chat']); 
        
        $message = "Новая заявка на регистрацию: ".$name."\nEmail: ".$email."\nPhone: ".$phone;
        EmailMessage($message, $config['feedback_email'], 'Заявка на регистрацию');
    } catch (PDOException $e) {
        //echo "Ошибка: " . $e->getMessage();
        //$text = "Произошла ошибка";
    }

}
    $page_title = $config['project_name'].". Запрос";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
?>

                            <h1 class="mb-3 pt-5"><? echo $title; ?></h1>
                          
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <? echo $text; ?>
                            </div>
                                        

<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>
