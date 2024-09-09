<?
$UserData = $magiUsers->getUserByEmail($userEmail); 
$promo = $UserData['promo'];

$data = 'https://magikey.ru/?utm_up='.$promo;
require 'backend/phpqrcode-master/aprilgetqr.php';
?>

<div class="px-6 w-full md:px-10">
            <div class="max-w-7xl mb-4 mx-auto">
                <div class="border-gray-300 border-solid mb-1 pt-3 text-4xl text-gray-800 md:mb-1 md:mt-5 md:pt-5 md:text-5xl">Материалы</div>
                <div class="mb-3 text-base text-gray-500 md:mb-8 md:text-xl">Используйте для рекламы любой из методов (ссылку, промо-код, qr-код):</div>
                <div class="border-b border-gray-200 border-solid gap-8 grid pb-6 md:gap-8 grid-cols-4 md:mt-5 md:pb-10">
                    <section class="col-span-4">
                        <div class="mb-1 text-lg">Ваша ссылка</div>
                        <div x-data="{ open: false }" onclick="copyToClipboard('mainlink');" class="relative flex items-center group">
                            <input @click="open = ! open;"  type="text" name="mainlink" id="mainlink" value='https://magikey.ru/?utm_up=<?=$promo?>' readonly class="border border-gray-300 px-3 py-2.5 rounded-md shadow-sm text-gray-900 text-sm w-full focus:border-gray-500 focus:ring-gray-500 group-hover:border-gray-400 md:py-2 md:text-base">
                            <div class="bg-white absolute cursor-pointer flex h-6 mr-1.5 mt-0.5 right-0 text-gray-500 w-8 group-hover:text-gray-900">
                                <svg @click="open = ! open;" x-show="!open" class="h-5 ml-2 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                </svg>
                                <svg @click="open = ! open;" x-show="open" class="h-5 ml-2 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div class="mb-2 mt-1 text-gray-500 text-sm">Поставьте ссылку в текст &mdash; человек, который перейдет по ней будет засчитан. Советуем также использовать utm_source, чтобы в вашей статистике вы могли отслеживать источники. <span @click="open = ! open;" class="cursor-pointer hover:text-gray-700">Показать примеры</span>.
                            </div>
                            <div x-show="open">
                                <div class="mb-1 mt-4 text-gray-500 text-sm">Ваша ссылка с utm_source для VK:</div>
                                <div x-data="{ open: false }" onclick="copyToClipboard('vklink');" class="relative flex items-center group">
                                    <input @click="open = ! open;"  type="text" name="vklink" id="vklink" value='https://magikey.ru/?utm_up=<?=$promo?>&utm_source=vk' readonly class="border border-gray-300 px-3 py-2.5 rounded-md shadow-sm text-gray-900 text-sm w-full focus:border-gray-500 focus:ring-gray-500 group-hover:border-gray-400 md:py-2 md:text-base">
                                    <div class="bg-white absolute cursor-pointer flex h-6 mr-1.5 mt-0.5 right-0 text-gray-500 w-8 group-hover:text-gray-900">
                                        <svg @click="open = ! open;" x-show="!open" class="h-5 ml-2 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                        </svg>
                                        <svg @click="open = ! open;" x-show="open" class="h-5 ml-2 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 6 9 17l-5-5"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mb-1 mt-4 text-gray-500 text-sm">Ваша ссылка с utm_source Telegram:</div>
                                <div x-data="{ open: false }" onclick="copyToClipboard('telegramlink');" class="relative flex items-center group">
                                    <input @click="open = ! open;" type="text" name="telegramlink" id="telegramlink" value='https://magikey.ru/?utm_up=<?=$promo?>&utm_source=telegram' readonly class="border border-gray-300 px-3 py-2.5 rounded-md shadow-sm text-gray-900 text-sm w-full focus:border-gray-500 focus:ring-gray-500 group-hover:border-gray-400 md:py-2 md:text-base">
                                    <div class="bg-white absolute cursor-pointer flex h-6 mr-1.5 mt-0.5 right-0 text-gray-500 w-8 group-hover:text-gray-900">
                                        <svg @click="open = ! open;" x-show="!open" class="h-5 ml-2 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                        </svg>
                                        <svg @click="open = ! open;" x-show="open" class="h-5  ml-2 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 6 9 17l-5-5"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="col-span-4 md:col-span-2">
                        <div class="mb-1 text-lg">Промокод</div>
                        <div x-data="{ open: false }" onclick="copyToClipboard('mypromo');" class="relative flex items-center group cursor-pointer">
                            <input @click="open = ! open;" type="text" name="mypromo" id="mypromo" value='<?=$promo?>' readonly class="w-full border border-gray-300 text-gray-900 rounded-md shadow-sm py-2 px-3 group-hover:border-gray-400 focus:border-gray-500 focus:ring-gray-500 text-base">
                            <div class="bg-white absolute cursor-pointer flex h-6 mr-1.5 mt-0.5 right-0 text-gray-500 w-8 group-hover:text-gray-900">
                                <svg @click="open = ! open;" x-show="!open" class="h-5 ml-2 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                </svg>
                                <svg @click="open = ! open;" x-show="open" class="h-5 w-5 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mb-2 mt-1 text-gray-500 text-sm">Человек, который при регистрации на сайте укажет промокод будет засчитан.</div>
                    </section>
                    <section class="col-span-4 md:col-span-2">
                        <div class="mb-1 text-lg">QR код</div>
                        <div class="flex">
                            <div class="w-60 max-w-full">
                                 <a target=_blank href="<?=$safe_qr_filename?>"><img class="max-w-full h-auto" src="<?=$safe_qr_filename?>" alt="QR код"></a>
                            </div>
                            <div class="mb-2 ml-4 text-gray-500 text-sm">В картинке зашифрован ваш личный промокод. Покажите эту картинку &mdash; человек, который откроет камерой и перейдет на сайт будет засчитан.                         
                                <button x-ref="code" type="button" class="bg-white flex font-medium items-center mt-2 pb-1.5 pl-2.5 pr-3 pt-1 ring-1 ring-gray-300 rounded-md shadow-sm text-gray-600 text-sm focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-teal-500 focus:outline-none hover:ring-gray-400 hover:text-gray-900">
                                    <svg class="mr-1 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 17V3"/>
                                        <path d="m6 11 6 6 6-6"/>
                                        <path d="M19 21H5"/>
                                    </svg>
                                    <a target=_blank href="<?=$safe_qr_filename?>">Скачать</a></span>
                                </button>
                            </div>
                        </div>
                    </section>
                </div>

                <!--
                <div class="border-gray-300 border-solid mt-2 pt-3 text-2xl text-gray-800 md:mt-5 md:pt-5 md:text-3xl">Визуал</div>
                <div class="mb-3 text-base text-gray-500 md:mb-3 md:text-xl">Можете использовать эти изображения в своей рекламе</div>
                <div class="gap-4 md:gap-8 grid grid-cols-2 pb-14 md:grid-cols-3">
                    <section class="cursor-pointer hover:border-gray-400 group">
                        <img src='/assets/img/Magikey_Promo004.2_sq.jpg' class="border border-solid border-white group-hover:border-gray-400 rounded-md">
                        <button x-ref="code" type="button" class="bg-white flex font-medium items-center mt-4 pb-1.5 pl-2.5 pr-3 pt-1 ring-1 ring-gray-300 rounded-md shadow-sm text-gray-600 text-sm focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-teal-500 focus:outline-none hover:ring-gray-400 hover:text-gray-900">
                            <svg class="mr-1 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 17V3"/>
                                <path d="m6 11 6 6 6-6"/>
                                <path d="M19 21H5"/>
                            </svg>
                            <span>Скачать</span>
                        </button>
                    </section>
                    <section class="cursor-pointer hover:border-gray-400 group">
                        <img src='/assets/img/Magikey_Promo004.2_sq.jpg' class="border border-solid border-white group-hover:border-gray-400 rounded-md">
                        <button x-ref="code" type="button" class="bg-white flex font-medium items-center mt-4 pb-1.5 pl-2.5 pr-3 pt-1 ring-1 ring-gray-300 rounded-md shadow-sm text-gray-600 text-sm focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-teal-500 focus:outline-none hover:ring-gray-400 hover:text-gray-900">
                            <svg class="mr-1 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 17V3"/>
                                <path d="m6 11 6 6 6-6"/>
                                <path d="M19 21H5"/>
                            </svg>
                            <span>Скачать</span>
                        </button>
                    </section>
                    <section class="cursor-pointer hover:border-gray-400 group">
                        <img src='/assets/img/Magikey_Promo004.2_sq.jpg' class="border border-solid border-white group-hover:border-gray-400 rounded-md">
                        <button x-ref="code" type="button" class="bg-white flex font-medium items-center mt-4 pb-1.5 pl-2.5 pr-3 pt-1 ring-1 ring-gray-300 rounded-md shadow-sm text-gray-600 text-sm focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-teal-500 focus:outline-none hover:ring-gray-400 hover:text-gray-900">
                            <svg class="mr-1 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 17V3"/>
                                <path d="m6 11 6 6 6-6"/>
                                <path d="M19 21H5"/>
                            </svg>
                            <span>Скачать</span>
                        </button>
                    </section>
                </div> -->
            </div>
        </div>

<script>
function copyToClipboard(inputname) {
    const input = document.getElementById(inputname);

    input.select();
    input.setSelectionRange(0, 99999); // Для мобильных устройств

    document.execCommand('copy');

    const originalValue = input.value;
    input.select();
    document.execCommand('copy');

    input.value = "Скопировано";

    setTimeout(() => {
    input.value = originalValue;
    }, 2000);
}
</script>