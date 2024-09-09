<?php
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (isset($_SESSION['email'])) {
    header("Location: /tools/");
} 

$page_title = $config['project_name'].". Ваше приглашение";
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';

$text_message = "";
$invitecode = "";

if (isset($_POST['promocode'])) {
    $enteredPromocode = filter_var($_POST['promocode'], FILTER_SANITIZE_STRING);   
    $enteredPromocode = strtoupper($enteredPromocode); // Преобразуем введенный промокод в верхний регистр

    require_once $_SERVER['DOCUMENT_ROOT'] . '/login/promocodes.php';

    if (in_array($enteredPromocode, $promocodes)) {
        siteStatistics('Invite', 'Успешно, '.$enteredPromocode); 
        header("Location: /login/register/?invite=".$enteredPromocode);
    } else {
        siteStatistics('Invite', 'Неверный код, '.$enteredPromocode); 
        $text_message = "<span class='text-error'>Неверный код приглашения. Попробуйте снова.</span>";
        $invitecode = $enteredPromocode;
    }
}

    $page_title = $config['project_name'].". Ваше приглашение";
?>
                            <h1 class="mb-3 pt-5">Регистрация</h1>
                            
                            <form action="/login/invite/" method="POST" class="mt-4">
                                <!-- Form -->
                                    <div class="form-group mb-4">
                                        <? echo $text_message; ?>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="promocode">Код промокод (или код приглашения):</label>
                                        <div class="input-group">                                                
                                            <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                            <input type="promocode" id="promocode" name="promocode" required class="form-control" placeholder="Код" value="<? echo $invitecode ?>">
                                        </div>  
                                    </div>
                                <button type="submit" class="btn btn-primary">Продолжить</button>
                                <div class="form-group mb-4">                                    
                                </div>   
                                <div class="form-group mb-4">                                    
                                </div> 

                                <div class="form-group mb-4">
                                  Если вы уже зарегистрированы — <a href="/login/"><u>войдите</u>.</a><br>    
                                    <small>У вас нет приглашения, но хотите его получить? <a href="/login/request/"><u>Отправьте запрос</u></a></small><br>
                                </div>                              
                            </form> 



<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>



