<?

session_start();

if (isset($_SESSION['email'])) {
    header("Location: /tools/");
} 

//echo $_POST['promocode'];


$error = "";
$invitecode = "";

if (isset($_GET['invite'])) {
    $enteredPromocode = filter_var($_GET['invite'], FILTER_SANITIZE_STRING);   
    $enteredPromocode = strtoupper($enteredPromocode); // Преобразуем введенный промокод в верхний регистр

    require_once $_SERVER['DOCUMENT_ROOT'] . '/login/promocodes.php';

    if (in_array($enteredPromocode, $promocodes)) {
        $h1 = "Приглашение принято 👌🏻";
        //header("Location: /login/register/?invite=".$_GET['invite']);
    } else {
        echo "Неверный код приглашения";
        header("Location: /login/invite/");
        //$invitecode = $_GET['promocode'];
    }
}
else {
    header("Location: /login/invite/");
}


if (isset($_GET['n'])) {
    $email = $_GET['email'];
    $phone = $_GET['p'];
    $name = $_GET['n'];
    $h1 = "Регистрация";
}

    $page_title = "M O D A GPT. Регистрация по приглашению";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
    siteStatistics('Register','Регистрация'); 
?>


                            <h1 class="mb-3 pt-5"><? echo $h1; ?></h1>
                            <div class="d-flex mt-4">
                                Пожалуйста, заполните эти поля:
                            </div>
                            <form action="/login/register/form/" method="POST" id="regform" class="mt-4">
                                <!-- Form -->

                                        <div class="form-group mb-4">
                                            <label for="name">Ваше имя</label>
                                            <div class="input-group">
                                                <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                                <input type="name" id="name" name="name" class="form-control" placeholder="Мария" value="<? echo $name; ?>">
                                            </div>  
                                        </div>
                                        <!-- End of Form -->
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="email">Ваш email</label>
                                            <div class="input-group">
                                                <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                                <input type="email" id="email" name="email" required class="form-control" placeholder="primer@mail.ru" value="<? echo $email; ?>">
                                            </div>  
                                        </div>
                                        <!-- End of Form -->
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="phone">Ваш телефон</label>
                                            <div class="input-group">
                                                <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                                <input type="phone" id="phone" name="phone" class="form-control" placeholder="+7 916 123 45 67" value="<? echo $phone; ?>">
                                            </div>  
                                        </div>
                                        <!-- End of Form -->
                                        <div class="form-group">
                                            <!-- Form -->
                                            <div class="form-group mb-4">
                                                <label for="password1">Придумайте пароль</label>
                                                <div class="input-group">
                                                    <!-- <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span> -->
                                                    <input type="password" id="password1" required name="password" class="form-control">
                                                </div>  
                                            </div>
                                            <!-- End of Form -->
                                        </div>
                                        <div class="form-group">
                                            <!-- Form -->
                                            <div class="form-group mb-4">
                                                <label for="password2">Повторите пароль</label>
                                                <div class="input-group">
                                                    <!-- <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span> -->
                                                    <input type="password" id="password2" name="password2" class="form-control"> 
                                                </div>  
                                            </div>
                                            <!-- End of Form -->
                                        </div>

                                        <div class="form-group" id="passwordError" style="display: none";>
                                            <!-- Form -->
                                            <div class="form-group mb-4">
                                                <div>
                                                    <span class='text-error'>Введенные пароли должны быть одинаковыми</span>  
                                                </div>  
                                            </div>
                                            <!-- End of Form -->
                                        </div>
                                <input type="hidden" id="promo" name="promo" value="<? echo $enteredPromocode; ?>">
                                <button type="submit" id="submit" class="btn btn-primary">Зарегистрироваться</button>
                                <div class="d-flex mt-4">
                                        <small>Согласие на обработку персональных данных</small>
                                </div>
                            </form> 

<script>
    // Получаем элементы формы и кнопку отправки
    const form = document.getElementById("regform");
    const password1Input = document.getElementById("password1");
    const password2Input = document.getElementById("password2");
    const submitButton = document.getElementById("submit");
    const passwordError = document.getElementById("passwordError");

    submitButton.disabled = true; // 

    // Добавляем обработчик события input для паролей
    password1Input.addEventListener("input", checkPasswordsMatch);
    password2Input.addEventListener("input", checkPasswordsMatch);

    // Функция для проверки совпадения паролей и блокировки кнопки отправки
    function checkPasswordsMatch() {
      const password1 = password1Input.value;
      const password2 = password2Input.value;

      if (password1 === password2) {
        submitButton.disabled = false; // Разблокировка кнопки
        passwordError.style.display = "none"; 
      } else {
        submitButton.disabled = true; // Блокировка кнопки
        if (password1 && password2) {
            passwordError.style.display = "block"; 
        }
      }
    }  
</script>

<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>