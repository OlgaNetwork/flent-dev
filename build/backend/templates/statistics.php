<?php

$reg_data = $magiCounter->getUtmUPBy30days($promo, $userdata_reg);
$count = count($reg_data);

?>

<div class="px-6 w-full md:px-10">
            <div class="max-w-7xl mb-4 mx-auto">
                <div class="border-gray-300 border-solid mb-1 md:mb-1 md:mt-5 md:pt-5 md:text-5xl pt-3 text-4xl text-gray-800">Статистика регистраций</div>
                <div class="mb-2 text-base text-gray-500 md:mb-4 md:text-xl">На основе данных о ссылке, QR-коде и промокоде</div>
                <div class="border-gray-300 border-solid mb-1 text-4xl md:mb-1 md:text-5xl text-gray-800"><?=$count?></div>
                <div x-show="open" class="bg-gray-100 divide-y mt-1 px-4 py-1 rounded-lg">
                    <div class="flex py-2 text-gray-400">
                        <div class="text-sm mr-2">#</div>
                        <div class="text-sm md:text-base w-2/3 md:w-1/4">Email</div>
                        <div class="hidden md:block w-1/2 md:w-1/4">Переход</div>
                        <div class="hidden md:block w-1/2 md:w-1/4">Регистрация</div>
                        <div class="hidden md:block w-1/2 md:w-1/4">Источник</div>
                        <div class="block text-sm w-1/3 md:hidden" "">Переход<br>Регистрация<br>Источник
                        </div>                         
                    </div>

                    <?     
                        $n = 0;
                        foreach ($reg_data as $item) { 
                            $n = $n + 1;

                        ?>
                    <div class="flex py-2">
                        <div class="mr-2 text-gray-400"><?=$n?>:</div>
                        <div class="w-2/3 md:w-1/4"><?=maskEmail($item['email'])?></div>
                        <div class="hidden md:block w-1/2 md:w-1/4"><?=$item['utmtime']?></div>
                        <div class="hidden md:block w-1/2 md:w-1/4"><?=$item['regtime']?></div>
                        <div class="hidden md:block w-1/2 md:w-1/4"><?=getUtmDescription($item['utm_source'])?></div>                         
                        <div class="block text-sm w-1/3 md:hidden"><?=$item['utmtime']?><br><?=$item['regtime']?><br><?=getUtmDescription($item['utm_source'])?></div>                         
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>






<?

function maskEmail($email) {
    // Проверяем, что строка содержит '@'
    if (strpos($email, '@') === false) {
    return $email; // Если нет @, возвращаем оригинал
    }
    
    // Разделяем email на части
    list($localPart, $domain) = explode('@', $email);
    
    // Обрабатываем локальную часть (до @)
    if (strlen($localPart) > 4) {
    $maskedLocalPart = substr($localPart, 0, 2) . str_repeat('*', strlen($localPart) - 4) . substr($localPart, -2);
    } else {
    // Если у нас 4 или меньше знаков перед @, просто оставим как есть
    $maskedLocalPart = $localPart;
    }
    
    // Обрабатываем доменную часть (после @)
    if (!preg_match('/@(mail\\.ru|ya\\.ru|yandex\\.ru)$/', $email)) {
    if (strpos($domain, '.') !== false) {
    $parts = explode('.', $domain);
    foreach ($parts as &$part) {
    if (strlen($part) > 3) {
    $part = substr($part, 0, 3) . str_repeat('*', strlen($part) - 3);
    }
    }
    $maskedDomain = implode('.', $parts);
    } else {
    // Если доменная часть без точки — просто скрыть всё кроме первых двух символов
    if (strlen($domain) > 2) {
    $maskedDomain = substr($domain, 0, 2) . str_repeat('*', strlen($domain) - 2);
    } else {
    $maskedDomain = $domain; // Оставляем как есть если слишком коротко
    }
    }
    } else {
    // Если это `@mail.ru`, `@ya.ru` или `@yandex.ru`, оставляем домен как есть
    $maskedDomain = $domain;
    }
    
    return "{$maskedLocalPart}@{$maskedDomain}";
}


function getUtmDescription($utm) {
    switch ($utm) {
        case 'qrcode':
            return 'QR код';
        case 'promo':
            return 'Промокод';
        case '':
                return 'Ссылка';
            default:
            return 'Ссылка (' . $utm . ')';
    }
}

?>