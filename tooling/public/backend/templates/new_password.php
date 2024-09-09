                        <h1 class="mb-3 pt-5">Придумайте пароль</h1>
                            <? echo $text_message; ?>
                            <form action="/login/confirm/form/" method="POST" id="regform" class="mt-4">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password1">Придумайте пароль</label>
                                    <div class="input-group">
                                        <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                        <input type="hidden" id="token" name="token" required class="form-control" placeholder="" value="<? echo $token; ?>">
                                        <input type="hidden" id="email" name="email" required class="form-control" placeholder="" value="<? echo $email; ?>">
                                        <input type="password" id="password1" name="password1" required class="form-control" placeholder="">
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password2">Повторите пароль</label>
                                        <div class="input-group">
                                            <!-- <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span> -->
                                            <input type="password" id="password2" name="password2" required placeholder="" class="form-control">
                                        </div>  
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
                                    <!-- End of Form -->
                                </div>
                                <button type="submit" id="submit" class="btn btn-primary">Сохранить пароль и войти</button>
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
