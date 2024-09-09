<?php



class magiStat extends Model
{
    public $config;
    public $db;

    public function init()
    {
        if (!isset($this->config)) {
            // Получаем параметры подключения из конфигурации
            $this->config = $this->getDatabaseConfig();

            // Подключение к базе данных
            $this->connectToDatabase();
        }
    }

    private function getDatabaseConfig()
    {
        return require $_SERVER['DOCUMENT_ROOT'] . '/magiStat/magiStatConfig.php';
    }



    private function connectToDatabase()
    {
        try {
            $dsn = "mysql:host=" . $this->config['host'] . ";port=" . $this->config['port'] . ";dbname=" . $this->config['dbname'];
            $this->db = new PDO($dsn, $this->config['username'], $this->config['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception('Database connection error: ' . $e->getMessage());
        }
    }

    public function getStatById($id)
    {
        // Инициализируем подключение к базе данных
        $this->init();

        // Подготавливаем SQL запрос
        $stmt = $this->db->prepare("SELECT * FROM magistat WHERE id = ?");
        // Выполняем запрос с передачей ID
        $stmt->execute([$id]);
        // Возвращаем результат в виде ассоциативного массива
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    public function insertData($block, $tool, $content, $pageView, $statEmail = '')
    {
        $this->init();

        // Получение или установка hash
        $hash = isset($_COOKIE['mst_hash']) ? $this->isNumberAndLatin($_COOKIE['mst_hash']) : uniqid();
        if (!isset($_COOKIE['mst_hash'])) {
            $this->setHashCookie($hash);
        }

        if ($statEmail =='') $statEmail = getUser()[0];

        // Получение данных о пользователе и его устройстве
        $UAgent = str_replace(["'", "\""], "", $_SERVER['HTTP_USER_AGENT']);
        $browser_info = $this->getUserBrowser($UAgent);
        $operating_system = $browser_info['os'];
        $browser = $browser_info['browser'];
        $device = $this->isMobileDesktopBrowser($UAgent);

        // Получение реферера, IP, URI
        $HReferer = str_replace(["https://", "http://"], "", getenv("HTTP_REFERER"));
        $UIp = getenv("REMOTE_ADDR");
        $RUri = getenv("REQUEST_URI");

        // Получение UTM меток
        $utm_source = $this->getUtmSource();
        $utm_campaign = $this->getUtmCampaign();
        $utm_medium = $this->getUtmMedium();
        $utm_content = $this->getUtmContent();
        $utm_term = $this->getUtmTerm();
        $utm_up = $this->getUtmUp();
        $utm_promo = $this->getPromo();

        // Подготовка данных для вставки
        $data = [
            'hash' => $hash,
            'pageView' => $pageView,
            'userEmail' => $statEmail,
            'block' => $block,
            'tool' => $tool,
            'content' => $content,
            'referer' => $HReferer,
            'utm_source' => $utm_source,
            'utm_campaign' => $utm_campaign,
            'utm_medium' => $utm_medium,
            'utm_content' => $utm_content,
            'utm_term' => $utm_term,
            'utm_up' => $utm_up,
            'utm_promo' => $utm_promo,
            'userAgent' => $UAgent,
            'userIp' => $UIp,
            'url' => $RUri,
            'os' => $operating_system,
            'device' => $device,
            'browser' => $browser
        ];

        // SQL запрос для вставки данных
        $sql = "INSERT INTO magistat (hash, pageView, userEmail, block, tool, content, referer, utm_source, utm_campaign, utm_medium, utm_content, utm_term, utm_up, utm_promo, userAgent, userIp, url, os, device, browser) 
                VALUES (:hash, :pageView, :userEmail, :block, :tool, :content, :referer, :utm_source, :utm_campaign, :utm_medium, :utm_content, :utm_term, :utm_up, :utm_promo, :userAgent, :userIp, :url, :os, :device, :browser)";

        // Подготовка и выполнение запроса
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }




public function getUser() {
    if (isset($_COOKIE['auth'])) {
        $username[0] = $_COOKIE['auth'];
        $username[1] = $_COOKIE['id'];        
    } else {
        $username[0] = "";
        $username[1] = "";  
    }
    return $username;
}



    public function isNumberAndLatin($variable) {
        $sanitizedString = preg_replace("/[^a-zA-Z0-9_-]+/", "", $variable);    
        return $sanitizedString;
    }





    public function getPromo() {
        if( isset( $_GET['promo'] ) )  {
            $utm = htmlspecialchars($_GET['promo']);
            $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
            setcookie('mst_promo', $utm, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
        }
       /* else if (isset($_COOKIE['mst_promo'])) {
            $utm = htmlspecialchars($_COOKIE['mst_promo']);
        }*/
        else $utm = '';

        return $utm;
    }

    public function getUtmUp() {
        if( isset( $_GET['utm_up'] ) )  {
            $utm = htmlspecialchars($_GET['utm_up']);
            $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
            setcookie('mst_up', $utm, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
        }
       /* else if (isset($_COOKIE['mst_up'])) {
            $utm = htmlspecialchars($_COOKIE['mst_up']);
        }*/
        else $utm = '';

        return $utm;
    }


    public function getUtmContent() {
        if( isset( $_GET['utm_content'] ) )  {
            $utm = htmlspecialchars($_GET['utm_content']);
            $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
            setcookie('mst_utm_content', $utm, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
        }
        /*else if (isset($_COOKIE['mst_utm_content'])) {
            $utm = htmlspecialchars($_COOKIE['mst_utm_content']);
        }*/
        else $utm = '';

        return $utm;
    }

    public function getUtmTerm() {
        if( isset( $_GET['utm_term'] ) )  {
            $utm = htmlspecialchars($_GET['utm_term']);
            $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
            setcookie('mst_utm_term', $utm, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
        }
       /* else if (isset($_COOKIE['mst_utm_term'])) {
            $utm = htmlspecialchars($_COOKIE['mst_utm_term']);
        }*/
        else $utm = '';

        return $utm;
    }


    public function getUtmMedium() {
        if( isset( $_GET['utm_medium'] ) )  {
            $utm = htmlspecialchars($_GET['utm_medium']);
            $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
            setcookie('mst_utm_medium', $utm, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
        }
       /* else if (isset($_COOKIE['mst_utm_medium'])) {
            $utm = htmlspecialchars($_COOKIE['mst_utm_medium']);
        }*/
        else $utm = '';

        return $utm;
    }


    public function getUtmCampaign() {
        if( isset( $_GET['utm_campaign'] ) )  {
            $utm = htmlspecialchars($_GET['utm_campaign']);
            $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
            setcookie('mst_utm_campaign', $utm, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
        }
       /* else if (isset($_COOKIE['mst_utm_campaign'])) {
            $utm = htmlspecialchars($_COOKIE['mst_utm_campaign']);
        }*/
        else $utm = '';

        return $utm;
    }


    public function getUtmSource() {
        if( isset( $_GET['utm_source'] ) )  {
            $utm = htmlspecialchars($_GET['utm_source']);
            $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
            setcookie('mst_utm_source', $utm, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
        }
       /* else if (isset($_COOKIE['mst_utm_source'])) {
            $utm = htmlspecialchars($_COOKIE['mst_utm_source']);
        }*/
        else $utm = '';

        return $utm;
    }

    public function setHashCookie($hash) {
        $expire = time() + (10 * 365 * 24 * 60 * 60); // Вычисляем время истечения срока действия (3 года в секундах)
        setcookie('mst_hash', $hash, $expire, '/'); // Устанавливаем куку с именем 'auth', значением $username, сроком действия $expire и доступной на всем сайте ('/')
    }

    public function getUserBrowser($userAgent) {
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


    public function isMobileDesktopBrowser ($user_agent) {
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



}


