<?
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

if (isset($_COOKIE['auth'])) header("Location: /");



$email = "";
$error = "";

if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

if (isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
}



if ((!isset($_GET['back']))&&($_SERVER["REQUEST_METHOD"] == "POST")) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';
    

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_EMAIL);
    

    try {
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($row) {
            if ($row['active'] == '0') {
                
                $error_h1 = "Удаленный пользователь";
                $text_message = "Данный пользователь по какой-то причине больше не cможет авторизоваться :(";

                //$magiStat = new magiStat(); $magiStat->insertData('Login error 4', '', 'Заблокированный пользователь. '.$email.'.', 0, $email);

                $error_button_url = "/login/?back&email=".$email;
                $error_button_text  = "Страница входа";

                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/error_message_button.php';
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';
            }
            if ($row['active'] == '2') {
                //siteStatistics('Login error 3','Неудачный вход. '.$email.'. не подтвержена почта');
                //$magiStat = new magiStat(); $magiStat->insertData('Login error 3', '', 'Неудачный вход. '.$email.'. не подтвержена почта', 0, $email);

                $error_h1 = "Подтвердите почту";
                $text_message = "На ваш почтовый адрес <b>$email</b> было выслано письмо. <br>В письме находится ссылка для первого входа.<br><br>Если вы не получили письмо, пожалуйста, проверьте папку \"Спам\".";
                $error_button_url = "/login/?back";
                $error_button_text  = "Войти";
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/error_message.php';
                require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';

                EmailTokenMessage($email, $row['reg_token']);
                exit();
            }


            if (password_verify($password, $row['password'])) {                
                if ($row['active'] == '1') {                // Пароль верный, аутентификация успешна
                    setAuthCookie($email, $row['ID']);
                    //siteStatistics('Login','Удачный вход');
                    //$magiStat = new magiStat(); $magiStat->insertData('Login', '', 'Удачный вход', 0, $email);
                }

                header("Location: /"); // Перенаправляем на другую страницу после успешной аутентификации
                exit();
            } else {
                //siteStatistics('Login error 1','Неудачный вход. '.$email.'. Пароль неверный');
                //$magiStat = new magiStat(); $magiStat->insertData('Login error 1', '', 'Неудачный вход. '.$email.'. Пароль неверный', 0, $email);
                $error = "<span class='text-error'>Проверьте правильность ввода пароля.</span>";
            }
        } else {
            //siteStatistics('Login error 2','Неудачный вход. '.$email.'. Email неверный');
            //$magiStat = new magiStat(); $magiStat->insertData('Login error 2', '', 'Неудачный вход. '.$email.'. Email неверный', 0, $email);
            $error = "<span class='text-error'>Не существует пользователя с такой электронной почтой.<br>Пожалуйста, проверьте правильность введенных данных и попробуйте еще раз.</span>";
        }
    } catch(PDOException $e) {
        //siteStatistics('System error','Ошибка BD');
        //$magiStat = new magiStat(); $magiStat->insertData('System error', '', 'Ошибка BD', 0, $email);
        //echo "Ошибка: " . $e->getMessage();
    }
}
    //siteStatistics('Login','Окно ввода');
    //$magiStat = new magiStat(); $magiStat->insertData('Login', '', 'Окно входа', 1);

    $page_title = $config['project_name'].". Вход";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
    

?>




                            <h1 class="mb-3 pt-5">Вход</h1>
                            <? echo $error; ?>
                            <form action="/login/" method="POST" class="mt-4">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">Ваш email</label>
                                    <div class="input-group">
                                        <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                        <input type="email" id="email" name="email" required class="form-control" placeholder="primer@company.ru" value="<? echo $email; ?>">
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Ваш пароль</label>
                                        <div class="input-group">
                                            <!-- <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span> -->
                                            <input type="password" id="password" name="password" required placeholder="" class="form-control">
                                        </div>  
                                    </div>
  
                                    <button type="submit" class="btn btn-primary">Войти</button>

<div class="form-group">
    <div class="form-group mb-4">
         <div class="input-group">
        </div> 
    </div> 
</div>

<div class="form-group">
    <div class="form-group mb-4">
         <div class="input-group">
        </div> 
    </div> 
</div>


<div class="form-group">
    <div><a href="/login/register/" class="text-right"><u>Регистрация</u></a></div> 
</div>

<div class="form-group pt-2">
    <div>Забыли пароль — <a href="/login/resetpassword/?email=<? echo $email; ?>" id="resetPasswordLink" class="text-right"><u>восстановить</u></a></div> 
</div>
</form> 



<script>    

var emailInput = document.getElementById('email');

emailInput.addEventListener('input', function(event) {

    var enteredEmail = event.target.value;
    var link = document.getElementById('resetPasswordLink');

    // Изменяем адрес ссылки
    link.href = '/login/resetpassword/?email='+enteredEmail;

});
</script>

<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>