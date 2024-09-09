<?
$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (isset($_SESSION['email'])) {
    header("Location: /tools/");
} 


    $page_title = $config['project_name'].". Запрос";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_header.php';
    siteStatistics('Request for registration',''); 
?>

                            <h1 class="mb-3 pt-5">Запрос</h1>
                            <form action="/login/request/form/" method="POST" class="mt-4">
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="name">Ваше имя</label>
                                            <div class="input-group">
                                                <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                                <input type="name" id="name" name="name" class="form-control" placeholder="Мария">
                                            </div>  
                                        </div>
                                        <!-- End of Form -->
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="email">Ваш email</label>
                                            <div class="input-group">
                                                <!-- <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span> -->
                                                <input type="email" id="email" name="email" class="form-control" placeholder="primer@mail.ru">
                                            </div>  
                                        </div>
                                        <!-- End of Form -->
                                        <div class="form-group">
                                            <!-- Form -->
                                            <div class="form-group mb-4">
                                                <label for="phone">Ваш телефон</label>
                                                <div class="input-group">
                                                    <!-- <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span> -->
                                                    <input type="phone" id="phone" name="phone" placeholder="+7 495 123-45-67" class="form-control">
                                                </div>  
                                            </div>
                                            <!-- End of Form -->
                                        </div>
                                        <button type="submit" class="btn btn-primary">Отправить</button>
                                    </form>


<?  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/templates/formpage_footer.php';  ?>


