<?
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

if (isset($_SESSION['email'])) {
    header("Location: /tools/");
} 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $login = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $promo = filter_var($_POST['promo'], FILTER_SANITIZE_STRING);  
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);    
    

    try {
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if ($email == $row['email']) {
                $error_h1 = "🤷🏻‍♂️";
                $text_message = "Пользователь с этой электронной почтой (".$email.") уже зарегистрирован.<br><br>Что можно сделать:<br>Если вы знаете пароль, попробуйте <a href='/login/?back&email=".$email."'><u>войти</u></a><br>
                Если заметили ошибку в адресе электронной почты, просто <a href='/login/register/?invite=".$promo."&n=".$login."&p=".$phone."'><u>продолжите регистрацию.</u></a><br><br>Если возникли сложности, пожалуйста, напишите нам <a href='https://t.me/hello_imagineB'><u>в телеграм</u></a>. Поможем.
                ";
                $error_button_url = "/login/register/?invite=".$promo."&email=".$email."&n=".$login."&p=".$phone;
                $error_button_text  = "Вернуться к регистрации";
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/error_message.php';
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';

                //siteStatistics('Registration 1','Уже существует. '.$email);
                //$magiStat = new magiStat(); $magiStat->insertData('RegistrationStep1Error', '', 'Уже существует', 0, $email);
                exit();
            }
        }
                    
        $reg_token = bin2hex(random_bytes(16)); // Токен отправим на почту, для её проверки        
        $data_reg = date('Y-m-d'); // Текущая дата

        // SQL-запрос для вставки нового пользователя
        $sql = "INSERT INTO users (login, email, phone, reg_token, active, token_counter, data_reg, data_session, session_counter, session_time_counter, promo, tariff)
                VALUES (:login, :email, :phone, :reg_token, 2, 0, :data_reg, NULL, 0, 0, :promo, 0)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':data_reg', $data_reg);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':reg_token', $reg_token);
        $stmt->bindParam(':promo', $promo);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

        //siteStatistics('Register','Успешная регистрация. '.$email, $email);  // Добавить бы промокод или UTM???
        //$magiStat = new magiStat(); $magiStat->insertData('RegistrationStep1', '', 'Успешная регистрация. '.$email, 0, $email);
        EmailTokenMessage($email, $reg_token);

        $user_ip = $_SERVER['REMOTE_ADDR']; // Получаем IP-адрес пользователя
        //$message = "MAGIKEY:\nУра! Новая регистрация: \n".$login."\nEmail: ".$email."\nhttps://modagpt.ru/logs/?email=".$email."\n\nPhone: ".$phone."\n\nIP: ".$user_ip."\nhttps://modagpt.ru/logs/?userIp=".$user_ip."\n\nДля завершения регистрации: https://".$config['project_url']."/login/confirm/?e=" . urlencode($email) . "&t=" . $reg_token;
        
        $message = "MAGIKEY:\nУра! Новая регистрация: \n".$login."\nEmail: ".$email."\nhttps://mstat.magikey.ru/?limit=1000&fromt=all&email=".$email."\n\nPhone: ".$phone."\n\nIP: ".$user_ip."\nhttps://mstat.magikey.ru/?limit=1000&fromt=all&ip=".$user_ip."\n\n";


        TelegramMessage($message, $config['telegram_token'], $config['telegram_chat']); // https://t.me/Mo_GPT_site_webinar_bot

    } catch(PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}


    $page_title = $config['project_name'].". Вы зарегистрированы";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';




function getMailButton($email){
    $email_domains = [
    'ya.ru', 
    'yandex.ru',
    'yandex.kz',
    'yandex.by',
    'yandex.com',
    'mail.ru', 
    'bk.ru',
    'inbox.ru',
    'list.ru',
    'internet.ru',
    'gmail.com',
    'rambler.ru'
];

$answers = [
    'ya.ru' => 'mail.yandex.ru/search?request=',
    'yandex.ru' => 'mail.yandex.ru/search?request=',
    'yandex.kz' => 'mail.yandex.kz/search?request=',
    'yandex.by' => 'mail.yandex.by/search?request=',
    'yandex.com' => 'mail.yandex.com/search?request=', 
    'mail.ru' => 'e.mail.ru/search/?q_query=',
    'bk.ru' => 'e.mail.ru/search/?q_query=',
    'inbox.ru' => 'e.mail.ru/search/?q_query=',
    'list.ru' => 'e.mail.ru/search/?q_query=',
    'internet.ru' => 'e.mail.ru/search/?q_query=',        
    'gmail.com' => 'mail.google.com/mail/u/0/#search/', 
    'rambler.ru' => 'mail.rambler.ru/folder/INBOX?searchFolders=%23all&searchId=0&search='
];

$answersText = [
    'ya.ru' => 'Проверить на Яндекс.Почте',
    'yandex.ru' => 'Проверить на Яндекс.Почте',
    'yandex.kz' => 'Проверить на Яндекс.Почте',
    'yandex.by' => 'Проверить на Яндекс.Почте',
    'yandex.com' => 'Проверить на Яндекс.Почте', 
    'mail.ru' => 'Проверить на Mail.ru',
    'bk.ru' => 'Проверить на BK.ru',
    'inbox.ru' => 'Проверить на Inbox.ru',
    'list.ru' => 'Проверить на List.ru',
    'internet.ru' => 'Проверить на Internet.ru',
    'gmail.com' => 'Проверить на Gmail',
    'rambler.ru' => 'Проверить в почте Рамблер'
];


    ///$email = 'test@mail.ru';
    $query = 'hello@magikey.ru';

    $email_parts = explode('@', $email);
    $domain = $email_parts[1];

    if (in_array($domain, $email_domains) && isset($answers[$domain])) {
        $btn = "<a href='https://".$answers[$domain].$query."'><button type='submit' class='btn btn-primary'>".$answersText[$domain]."</button></a>";
        return $btn;
    } else {
        return '';
    }
}




?>

                            <h1 class="mb-3 pt-5">Спасибо 👌🏻<br>Теперь проверьте свой почтовый ящик</h1>
                            Для проверки электронной почты вам выслана ссылка на <b><? echo $email; ?></b>.<br>При переходе по ссылке сможете задать свой пароль и войти на сайт.<br><br>

                            <small>Если вы не получили письмо, пожалуйста, проверьте папку "Спам".</small>
                           
                            <div class="pt-2"><? echo getMailButton($email); ?></div>
                               








<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>