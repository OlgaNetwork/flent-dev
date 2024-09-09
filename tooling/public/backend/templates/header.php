<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <title><?=$title?></title>         
        <link href="/tailwind_theme/tailwind.css" rel="stylesheet" type="text/css">
        <script src="/assets/js/alpine.js" defer></script>
    </head>     
    <body> 
        <div class="bg-gray-100 pt-6 px-6 w-full md:pt-11 md:px-10">
            <div class="max-w-7xl mb-4 mx-auto">
                <div class="mb-1 relative md:mb-2"><a href="#"> <img class="h-8 sm:h-9 " src="/assets/img/logos/logo.svg" alt=""></a>
                    <nav class="absolute flex md:hidden right-0 top-0 z-20 z-50">
                        <div x-data="{ open: false }" class="block inline-block ml-2 relative text-left">
                            <svg @click="open = !open" class="cursor-pointer h-6 mb-2 ml-2 mt-1 text-gray-400 w-6 hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <div x-show="open" @click.away="open = false" class="absolute bg-white mt-2 origin-top-right px-2 py-2 right-0 ring-1 ring-black ring-opacity-5 rounded-md shadow-lg w-80"><span class="bg-white border-gray-200 flex group px-3 py-2 rounded-md text-base text-gray-500"><?=$userEmail?></span>
                                <div class="border-t mx-3 my-1"></div>
                                <a href="https://magikey.ru" class="bg-white border-gray-200 cursor-pointer flex group px-3 py-2 rounded-md text-base text-gray-900 hover:bg-gray-100">Сайт Magikey</a>
                                <a href="https://t.me/magikey_ai" class="bg-white border-gray-200 cursor-pointer flex group px-3 py-2 rounded-md text-base text-gray-900 hover:bg-gray-100">Magikey в Telegram</a>
                                <a href="/login/logout/" class="bg-white border-gray-200 cursor-pointer flex group px-3 py-2 rounded-md text-base text-gray-900 hover:bg-gray-100">Выход</a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="block">
                    <div class="bg-gray-100 flex pb-3 pt-1 md:pb-3">
                        <div> 
                            <nav class="flex font-medium space-x-4" aria-label="Tabs">
                                <? if ($page=='materials') echo '<span class="bg-gray-200 px-3 py-1.5 rounded-md text-gray-800 text-sm md:text-base">Материалы</span>'; 
                                    else echo '<a href="?c=materials" class="text-gray-600 hover:text-gray-800 py-1.5 text-sm md:text-base rounded-md">Материалы</a>'; 
                                ?>
                                <? if ($page=='statistics') echo '<span class="bg-gray-200 px-3 py-1.5 rounded-md text-gray-800 text-sm md:text-base">Статистика</span>'; 
                                    else echo '<a href="?c=statistics" class="text-gray-600 hover:text-gray-800 py-1.5 text-sm md:text-base rounded-md">Статистика</a>'; 
                                ?>
                                <? if ($page=='payments') echo '<span class="bg-gray-200 px-3 py-1.5 rounded-md text-gray-800 text-sm md:text-base">Выплаты</span>'; 
                                    else echo '<a href="?c=payments" class="text-gray-600 hover:text-gray-800 py-1.5 pl-1 text-sm md:text-base rounded-md">Выплаты</a>'; 
                                ?>
                            </nav>
                        </div>
                        <div class="w-full"></div>
                        <div x-data="{ open: false }" class="relative  hidden md:flex">
                            <div><a href="#" @click="open = !open" class="font-normal pl-3 pr-0.5 py-1.5 rounded-md text-gray-600 text-sm hover:text-gray-800 md:text-base"><?=$userEmail?></a>
                            </div>
                            <div class="pt-1">
                                <svg x-show="!open" class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -2 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                                <svg x-show="open" class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6"/>
                                </svg>
                            </div>
                            <div x-show="open" @click.away="open = false" class="absolute bg-white mt-2 origin-top-right px-2 py-2 right-0 ring-1 ring-black ring-opacity-5 rounded-md shadow-lg top-6 w-80">
                                <span class="bg-white border-gray-200 flex group px-3 py-2 rounded-md text-base text-gray-500"><?=$userEmail?></span>
                                <div class="border-t mx-3 my-1"></div>
                                <a href="https://magikey.ru" class="bg-white border-gray-200 cursor-pointer flex group px-3 py-2 rounded-md text-base text-gray-900 hover:bg-gray-100">Сайт Magikey.ru</a>
                                <a href="https://t.me/magikey_ai" class="bg-white border-gray-200 cursor-pointer flex group px-3 py-2 rounded-md text-base text-gray-900 hover:bg-gray-100">Magikey в Telegram</a>
                                <a href="/login/logout/" class="bg-white border-gray-200 cursor-pointer flex group px-3 py-2 rounded-md text-base text-gray-900 hover:bg-gray-100">Выход</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    