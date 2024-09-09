<?
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';


$h1 = "Восстановление пароля";
$textPage = "Пожалуйста, введите электронную почту, указанную при регистрации.";

if (isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
}

if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {            
            $token = bin2hex(random_bytes(16)); // Токен отправим на почту, для её проверки

            $sql = "UPDATE users SET reg_token = :token WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            //siteStatistics('Resetpassword','Восстановление пароля. '.$email); 
            //$magiStat = new magiStat(); $magiStat->insertData('Resetpassword', '', 'Восстановление пароля', 0, $email);
            $h1 = 'Проверьте свою почту';
            $text_message = 'Письмо для восстановления пароля отправлено.';
            $page_title = $config['project_name'].". Восстановление пароля";
            require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/message.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';
            EmailResetPassword($email, $token);
            //exit();
    }
    else {
        $h1 = "Восстановление пароля";
        $textPage = "Произошла ошибка.<br>Пользователь с данной электронной почтой отсутствует на нашем сайте.";
    }
}
    $page_title = $config['project_name'].". Восстановление пароля";
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
    //siteStatistics('Register','Регистрация'); 
    //$magiStat = new magiStat(); $magiStat->insertData('Resetpassword', '', 'Восстановление пароля', 1);
?>
                            <h1 class="mb-3 pt-5"><? echo $h1; ?></h1>
                            <div class="d-flex mt-4">
                                <? echo $textPage; ?>
                               
                            </div>
                            <form action="/login/resetpassword/" method="POST" id="regform" class="mt-4">
                                
                                <div class="form-group mb-4">
                                    <label for="email">Ваш email</label>
                                    <div class="input-group">
                                        <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                        <input type="email" id="email" name="email" required class="form-control" placeholder="primer@mail.ru" value="<? echo $email; ?>">
                                    </div>  
                                </div>
                                        
                                <button type="submit" id="submit" class="btn btn-primary">Сбросить пароль</button>
                            </form> 

<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>