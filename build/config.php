<?php

return [
    "project_name" => "Flent",
    "project_url" => "flent.ru",
    "project_robot_mail" => "hello@flent.ru",

    

    "telegram_token" => "6464926975:AAFuodjOj1-UQXgEZV5EcN9ShkDp_aWeDKw", // https://t.me/Mo_GPT_site_webinar_bot
    "telegram_chat" => "-1001915375167",

    "feedback_email" => "eugenych@yandex.ru",

    "error_log" => "error_log.txt",

    // это внутренние настройки (пользователи партнёрской программы, их промокод, их действия внутри партнёрской программы
    // действия можно смотреть тут: https://partners.magikey.ru/magiStat/
    $inside_settings = [ 
        'host' => 'localhost',
        'username' => 'vh594626_mkpartners_user',
        'password' => 'Fd24xS34wDhhjSweSfjrxAdffXvrqdxweSfjrxA',
        'dbname' => 'vh594626_mkpartners',
        'port' => 3306
    ],   

    // это действия пользователей для определения статистики для партнёров, utm и т.д.
    $outside_settings = [
        'host' => 'mysql-srv59651.hts.ru',
        'username' => 'srv59651_street',
        'password' => 'Dg544szffgAA3545ZfasFasXf@g',
        'dbname' => 'srv59651_street',
        'port' => 3306
    ]
];
