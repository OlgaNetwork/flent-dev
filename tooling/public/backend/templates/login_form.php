                        <h1 class="mb-3 pt-5">Вход</h1>
                            <? echo $text_message; ?>
                            <form action="/login/" method="POST" class="mt-4">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">Ваш email</label>
                                    <div class="input-group">
                                        <input type="email" id="email" name="email" required class="form-control" placeholder="primer@company.ru" value="<? echo $email; ?>">
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Ваш пароль</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" required placeholder="" class="form-control">
                                        </div> 
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
                                    <div><a href="/login/resetpassword/" id="resetPasswordLink" class="text-right">Восстановить пароль?</a></div> 
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