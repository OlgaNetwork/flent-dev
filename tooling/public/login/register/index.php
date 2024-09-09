<?

$h1 = "Регистрация";
    $page_title = "Регистрация";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
    //siteStatistics('Register','Регистрация'); 
    //$magiStat = new magiStat(); $magiStat->insertData('RegistrationPage', '', 'Страница регистрация', 1);
?>

                            <h1 class="mb-3 pt-5"><? echo $h1; ?></h1>
                            <div class="d-flex mt-4">
                            </div>
                            <form action="/login/register/form/" method="POST" id="regform" class="mt-4">
                                
                                <div class="form-group mb-4">
                                    <label for="email">Укажите ваш email</label>
                                    <div class="input-group">
                                        <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                        <input type="email" id="email" name="email" required class="form-control" placeholder="primer@mail.ru" value="<? echo $email; ?>">
                                    </div>  
                                </div>
                                
                                <div class="form-group mb-4">
                                    <input type="checkbox" id="agreement" name="agreement" value="ok" class="form-check-input">
                                    <small>Соглашаюсь на <a href='https://flent.ru/docs/Soglasie-data.pdf'><u>обработку персональных данных</u></a></small>
                                </div>
                                
                                
                                        
                                <input type="hidden" id="promo" name="promo" value="<? echo $enteredPromocode; ?>">
                                <button type="submit" id="submit" class="btn btn-primary">Зарегистрироваться</button>
                                <div class="d-flex mt-4">
                                        Если вы уже зарегистрированы — <a href="/login/"><u>войдите</u>.</a>
                                </div>
                                <div class="d-flex mt-4">
                                        
                                </div>
                            </form> 
                            
                            
<script>
    const agreement = document.getElementById("agreement");
    const submit = document.getElementById("submit");
    submit.disabled = true;
    
    agreement.addEventListener("change", function() {
    if (agreement.checked) {
        submit.disabled = false;
    } else {
        submit.disabled = true;
    }
});
</script>

<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>