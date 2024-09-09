<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/autoload.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/magiStat/magiStat/src/magiStat.php';


//////////////////////////////////////////////////// blacklist /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$blacklist = array(
    '84.54.51.31', // info@007strategies.com
    '0.0.0.0' // другой пример запрещенного IP
);

$user_ip = $_SERVER['REMOTE_ADDR']; // Получаем IP-адрес пользователя

if (in_array($user_ip, $blacklist)) { // Проверяем, есть ли IP-адрес пользователя в черном списке
    siteStatistics("AccessDenied",$user_ip);     
    header('HTTP/1.0 403 Forbidden'); // Если IP находится в черном списке, делаем редирект или выводим сообщение об ошибке
    echo "Access Denied";
    exit;
} 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$isLocalhost = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1');

if ($isLocalhost) {
    //echo "Это локальный сервер!";
    ini_set('display_errors', '0');
    ini_set('error_reporting', E_ALL & ~E_NOTICE);
} else {
    // Выключать ошибки
    ini_set('display_errors', '0');
    ini_set('error_reporting', E_ALL & ~E_NOTICE);

/*
    if (!isset($_SERVER['HTTPS'])) {
        $redirectUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header("Location: " . $redirectUrl);
        exit();
    }
*/
    if (strpos($_SERVER['HTTP_HOST'], 'www.') !== false) {
        $redirectUrl = "http://" . str_replace('www.', '', $_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];
        header("Location: " . $redirectUrl);
        exit();
    }    
}




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///// почта

function EmailTokenMessage($email, $reg_token) {
    global $config; 

    $to = $email;    
    $subject = $config['project_name'].'. Подтвердите электронную почту';
    $message = '<h1>👋🏻</h1>Перейдите по ссылке:<br><b>https://app.'.$config['project_url'].'/login/confirm/?e=' . urlencode($email) . '&t=' . $reg_token.'</b>, чтобы завершить регистрацию.';
    EmailMessage($message, $to, $subject);
}

function EmailResetPassword($email, $reg_token) {
    global $config; 

    $to = $email;
    $subject = $config['project_name'].'. Восстановление пароля';
    $message = 'Чтобы восстановить пароль, перейдите по ссылке:<br><b>https://app.'.$config['project_url'].'/login/resetpassword/confirm/?e=' . urlencode($email) . '&t=' . $reg_token.'</b>';
    EmailMessage($message, $to, $subject);
}


function EmailMessage($message, $to, $subject) {
        global $config; 
        //$subject = iconv('CP1251', 'UTF-8', $subject);


        $emailHTMLContent = '
        <html>
        <head>
            <title>'.$subject.'</title>
        </head>
        <body>
            <table width="100%">
                <tr>
                    <td style="text-align: left; background-color: #885BF1; height: 80px;">
                        <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                            <img src="https://'.$config['project_url'].'/assets/img/logos/png/email/?img='.$to.'" alt="'.$config['project_name'].'">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><br>
                        '. $message .'
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><br><br>С уважением,<br>команда '.$config['project_name'].'</p>
                    </td>
                </tr>
            </table>
        </body>
        </html>';

        $emailContent = $message.' С уважением,<br>команда '.$config['project_name'];

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();         
            $mail->CharSet = 'UTF-8';                                   //Send using SMTP
            $mail->Host       = 'smtp.yandex.ru';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'hello@flent.ru';                     //SMTP username
            $mail->Password   = 'Teqntdwd9VS764rZe4NmHAxh43';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    
            $mail->Port = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom('hello@flent.ru', 'Flent');
            $mail->addAddress($to, '');     //Add a recipient

            //Content
            $mail->isHTML(true);  
            $mail->ContentType = 'text/html';
            $mail->Encoding = 'base64';                                //Set email format to HTML
            $mail->Subject =  $subject;
            $mail->Body    =  $emailHTMLContent;
            $mail->AltBody =  $emailContent; //'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            TelegramMessage($to."Message could not be sent. Mailer Error: {$mail->ErrorInfo}", $config['telegram_token'], $config['telegram_chat']); 
        }
}


/*        $emailHTMLContent = '
<html>
<head>
    <title></title>
</head>
<body>
<table width="100%">
<tbody>
<tr>
    <td style="text-align: left; background-color: #885BF1; height: 80px;">
        <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
            <img src="https://'.$config['project_url'].'/assets/img/logos/png/email/?img='.$to.'" alt="'.$config['project_name'].'">
        </div>
    </td>
</tr>
<tr>
    <td>
    <p>Добрый день! На связи команда Magikey!</p>
    <p>Мы рады, что вы пользовались нашим сервисом и будем очень признательны за ваши отзывы.</p>

    <p>Наш проект развивается, и сейчас мы особенно открыты к вашим идеям и предложениям. Мы будем рады услышать, что вам понравилось, что можно улучшить, какие новые функции вы хотели бы видеть, и любые другие мысли. Ваши отзывы помогут нам стать лучше!</p>

    <p>Пожалуйста, не стесняйтесь делиться своими идеями и предложениями в ответ на это письмо или по адресу: <a href="mailto:hello@magikey.ru">hello@magikey.ru</a>. Спасибо, что помогаете нам расти и развиваться!</p>
    </td>
</tr>
<tr>
<td><br /><br /><img src="https://magikey.ru/assets/img/olga_fiole.jpg" alt="" width="98" height="98" />
<p>Ольга,<br />команда Magikey</p>
</td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>
</body>
</html>';*/


function EmailMessageHelloOlga($message, $to, $subject) {
        global $config; 
        //$subject = iconv('CP1251', 'UTF-8', $subject);

/*
        $emailHTMLContent = '
<html>
<head>
    <title></title>
</head>
<body>
<table width="100%">
<tbody>
<tr>
    <td style="text-align: left; background-color: #885BF1; height: 80px;">
        <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
            <img src="https://'.$config['project_url'].'/assets/img/logos/png/email/?img='.$to.'" alt="'.$config['project_name'].'">
        </div>
    </td>
</tr>
<tr>
    <td>
    <p>Добрый день,</p>
    <p>Меня зовут Ольга, рада приветствовать вас на сервисе цифрового помощника для риэлторов Magikey!</p>

    <p>Если у вас появятся идеи, рекомендации или предложения, пожалуйста, делитесь со мной по почте <a href="mailto:idea@magikey.ru">idea@magikey.ru</a>. Буду рада услышать ваши мысли, и с удовольствием их рассмотрим!</p>

    <p>Желаю вам продуктивной работы и создания отличных текстов!</p>
    </td>
</tr>
<tr>
<td><br /><br /><img src="https://magikey.ru/assets/img/olga_fiole.jpg" alt="" width="98" height="98" />
<p>Ольга,<br />команда Magikey</p>
</td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>
</body>
</html>';

        $emailContent = 'Magikey'; //$message.' С уважением,<br>команда '.$config['project_name'];

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();         
            $mail->CharSet = 'UTF-8';                                   //Send using SMTP
            $mail->Host       = 'smtp.yandex.ru';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'hello@magikey.ru';                     //SMTP username
            $mail->Password   = 'GmQyHFUkDvSW7fqsfE0nh27ec';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    
            $mail->Port = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom('hello@magikey.ru', 'Magikey');
            $mail->addAddress($to, '');     //Add a recipient

            //Content
            $mail->isHTML(true);  
            $mail->ContentType = 'text/html';
            $mail->Encoding = 'base64';                                //Set email format to HTML
            $mail->Subject =  $subject;
            $mail->Body    =  $emailHTMLContent;
            $mail->AltBody =  $emailContent; //'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            TelegramMessage($to."Message could not be sent. Mailer Error: {$mail->ErrorInfo}", $config['telegram_token'], $config['telegram_chat']); 
        }
        */
}






function TelegramMessage($message, $botToken, $chatId) {
    /*
    // Текст сообщения, которое вы хотите отправить
    //$message = '2 Mo_GPT_site_notification_bot Привет из PHP!';

    // URL для отправки запроса к Telegram Bot API
    $apiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";

    // Параметры запроса
    $params = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    // Инициализируем cURL-сессию
    $ch = curl_init($apiUrl);

    // Настраиваем cURL для отправки POST-запроса с параметрами
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Отправляем запрос и получаем ответ
    $response = curl_exec($ch);

    // Проверяем наличие ошибок
    if (curl_error($ch)) {
        //echo 'Ошибка при отправке запроса: ' . curl_error($ch);
    } else {
        // Распечатываем ответ
        //echo 'Ответ от Telegram API: ' . $response;
    }

    // Закрываем cURL-сессию
    curl_close($ch);*/
}

// Код для установки куки при авторизации
function setHashCookie($hash) {
    $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
    setcookie('hash', $hash, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
}

// Код для установки куки при авторизации
function setAuthCookie($username,$userId) {
    $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
    setcookie('auth', $username, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
    setcookie('id', $userId, $expire, '/');
}

// Код для проверки куки на других страницах
function checkAuthCookie() {
    if (isset($_COOKIE['auth'])) {
        // Кука 'auth' существует, пользователь авторизован
        $username[0] = $_COOKIE['auth'];
        $username[1] = $_COOKIE['id'];

        return $username;
        // Дополнительный код для обработки авторизованного пользователя
    } else {
        header("Location: /login/");
        exit();
        $username[0] = "";
        $username[1] = "";
        //header("Location: /");
        //exit();
        // Кука 'auth' не существует, пользователь не авторизован
        // Дополнительный код для обработки неавторизованного пользователя
        return $username;
    }
}


function getUser() {
    if (isset($_COOKIE['auth'])) {
        $username[0] = $_COOKIE['auth'];
        $username[1] = $_COOKIE['id'];        
    } else {
        $username[0] = "";
        $username[1] = "";  
    }
    return $username;
}


function isNumber($variable) {
    return is_numeric($variable);
}

function isLatinLetters($variable) {
    return preg_match('/^[a-zA-Z]+$/', $variable);
}

function isNumberAndLatin($variable) {
    $sanitizedString = preg_replace("/[^a-zA-Z0-9_-]+/", "", $variable);    
    return $sanitizedString;
}
///////////////// BD

function db_connect() {
    global $db_server; 
    global $db_username; 
    global $db_password; 
    global $db_name; 

    $conn = new mysqli($db_server, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function saveId($blockname) {
    $conn = db_connect();

    $userEmail = checkAuthCookie()[0];
    $userId = checkAuthCookie()[1];

    $uuid = uniqid();
// $uuid = md5($uuid);    
   
    $sql = "INSERT INTO chats (uuid, block, userId, userEmail) VALUES ('$uuid', '$blockname', '$userId', '$userEmail')";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully.";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $id = $conn->insert_id;
    //echo "The generated id is: " . $id;

    $conn->close();

    return $id;
}

function getId($uuid) {
    $conn = db_connect();

    $sql = "SELECT * FROM chats WHERE uuid = '$uuid' LIMIT 1";
    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["id"];
        // Access the columns of the retrieved row using the associative array
        //echo "The record is: ";
        //echo "Column 1: " . $row["id"] . ", Column 2: " . $row["block"];

    } else {
        //echo "No rows found.";
    }    
}


function saveBDMessage($role,$content,$chat_id) {
    $conn = db_connect();

    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/token_counter/gpt3-encoder.php';
    $token_array = gpt_encode($content);
    $token = count($token_array);

    $sql = "INSERT INTO messages (role, content, token, chat_id) VALUES ('$role', '$content', '$token', '$chat_id')";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully.";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}


function siteStatistics($block,$content,$statEmail='') {
/*
    TelegramMessage($block." ".$content, '6663366053:AAF7vCN0lshNFPlMtR7w_cON83g-iXMA3fE', '-1001636166175');
    $conn = db_connect();

    $block = "Magikey. ".$block;

    $hash = "";
    if (isset($_COOKIE['hash'])) {
        $hash = isNumberAndLatin($_COOKIE['hash']);
    }
    else {
        $hash = uniqid();
        setHashCookie( $hash );
    }

    $userEmail = getUser()[0];

    $UAgent = $_SERVER['HTTP_USER_AGENT']; // получаем данные о софте, 
    $UAgent=str_replace("'","",$UAgent);
    $UAgent=str_replace("\"","",$UAgent);
    $browser_info = getUserBrowser($_SERVER['HTTP_USER_AGENT']);
    $operating_system = $browser_info['os']; //echo "Операционная система: " . $operating_system . "<br>";
    $browser = $browser_info['browser']; // echo "Браузер: " . $browser;
    $device = isMobileDesktopBrowser ($_SERVER['HTTP_USER_AGENT']); 
    $H=getenv("HTTP_REFERER"); // получаем URL, с которого пришёл посетитель 
    $H=str_replace("https://","",$H);
    $HReferer=str_replace("http://","",$H);  

    $UIp=getenv("REMOTE_ADDR"); // получаем IP посетителя 

    $RUri=getenv("REQUEST_URI"); // получаем относительный адрес странички, 

    if( isset( $_GET['utm_source'] ) )  $utm_source = htmlspecialchars($_GET['utm_source']);
    else $utm_source = "";

    if( isset( $_GET['utm_campaign'] ) )  $utm_campaign = htmlspecialchars($_GET['utm_campaign']);
    else $utm_campaign = "";

    $sql = "INSERT INTO sitestatistics (hash, userEmail, block, content, referer, utm_source, utm_campaign, userAgent, userIp, url, os, device, browser) 
    VALUES ('$hash', '$userEmail', '$block', '$content', '$HReferer', '$utm_source', '$utm_campaign', '$UAgent', '$UIp', '$RUri', '$operating_system', '$device', '$browser')";

    if ($statEmail!='')     $sql = "INSERT INTO sitestatistics (hash, userEmail, block, content, referer, utm_source, utm_campaign, userAgent, userIp, url, os, device, browser) 
    VALUES ('$hash', '$statEmail', '$block', '$content', '$HReferer', '$utm_source', '$utm_campaign', '$UAgent', '$UIp', '$RUri', '$operating_system', '$device', '$browser')";

    

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully.";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();*/
}


function isMobileDesktopBrowser ($user_agent) {
    // Определение ключевых слов для мобильных устройств
    $mobile_keywords = [
        'Mobile',
        'Android',
        'iPhone',
        'Windows Phone'
    ];

    $is_mobile = false;

    // Проверка, содержит ли User-Agent ключевые слова для мобильных устройств
    foreach ($mobile_keywords as $keyword) {
        if (stripos($user_agent, $keyword) !== false) {
            $is_mobile = true;
            break;
        }
    }
    if ($is_mobile) {
        //echo "Мобильная версия";
        return "Mobile";
    } else {
        //echo "Десктопная версия";
        return "Desktop";
    }
}


function getUserBrowser($userAgent) {
    // Массив со значениями ОС и браузера
    $osArray = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
    '/win98/i'              =>  'Windows \'98', 
    '/win95/i'              =>  'Windows \'95', 
    '/win16/i'              =>'Windows \'3.11', 
    '/macintosh|mac os x/i' =>'Mac OS X', 
    '/mac_powerpc/i'=>  'Mac OS X', 
    '/linux/i'=>            'LINUX', 
       );

    $browserArray = array(
    '/Googlebot/i'=>'Googlebot', 
    '/Yahoo! Slurp;/i'=>'Yahoo! Slurp;',
    '/Opera Mini/i'=>'Opera Mini',
    '/Opera/i' =>'Opera',
        '/Edge/i'           =>  'Microsoft Edge',
        '/Chrome/i'         =>  'Google Chrome',
        '/Safari/i'         =>  'Safari',
        '/Firefox/i'        =>  'Mozilla Firefox',
        '/MSIE/i'           =>  'Internet Explorer'
       );

    $os = "Неизвестно";
    $browser = "Неизвестно";

    // Находим ОС
    foreach ($osArray as $regex => $value) { 
        if (preg_match($regex, $userAgent)) {
            $os = $value;
            break;
        }
    }

    // Находим браузер
    foreach ($browserArray as $regex => $value) { 
    if (preg_match($regex, $userAgent)) {
            $browser = $value;
            break;
        }
    }

    return array("os" => $os, "browser" => $browser);
}

function remove_query_arg($key, $url) { /// убрать лишние аргументы в URL (для переключения языков, может где ещё нужно будет)
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    unset($query[$key]);
    $new_query = http_build_query($query);
    return $parts['path'] . ($new_query ? '?' . $new_query : '');
}


?>
