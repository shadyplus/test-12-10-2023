<?php

define('LANDING_DIR', '');

$apiKey = 'AHVGvindjxDs8dDdnwq6erw7FTbLdwKdiMDU9wg3VxVBouy0mpLX6c4A';          // Ключ доступа к API
$offer_id = 9791;         // для каждого оффера свой айди, надо уточнять его в админке или у суппортов
$stream_hid = 'JMyuQrZo';     // id потока
$landKey = 'c437fa2bfe884578a204571c356101e2';

$default_main_site = 'http://api.cpa.tl';
//$default_main_site = 'http://api.tradeblg.ru';
$apiSendLeadUrl = 'http://api.cpa.tl/api/lead/send_archive';
//$apiSendLeadUrl = 'http://api.tradeblg.ru/api/lead/send_archive';
$apiGetLeadUrl = 'http://api.cpa.tl/api/lead/feed';
//$apiGetLeadUrl = 'http://api.tradeblg.ru/api/lead/feed';

$dataOffers = '{"33437":{"id":33437,"name":"RHINO","country":{"code":"DZ","name":"\u0410\u043b\u0436\u0438\u0440"},"price":"5999","price2":"11998","currency":{"code":"DZD","name":"DA"}}}';
$dataOffer = '{"id":33437,"name":"RHINO","country":{"code":"DZ","name":"\u0410\u043b\u0436\u0438\u0440"},"price":"5999","price2":"11998","currency":{"code":"DZD","name":"DA"}}';
$is_geo_detect = '';
$productName = 'RHINO';
$invoice = 'index.php';
$push_link = '';
$language = 'fr';
$companyInfo = array('address' => '283023, ДОНЕЦКАЯ НАРОДНАЯ РЕСПУБЛИКА, ГОРОДСКОЙ ОКРУГ ДОНЕЦК, Г. ДОНЕЦК, УЛ. ЭЛЕВАТОРНАЯ, Д. 21А', 'detail' => 'ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "ТОРГОВЫЙ ДОМ "ЛИДЕР ТОРГ"  ОГРН: 1229300127055  ИНН: 9308018367  КПП: 930801001 e-mail: Leader@Yandex.ru skype : Leader');
$companyInfoEN = array('address' => '16 George street, London, UK. skype: Galaxy-trade, email: Galaxy-trade2000@gmail.com', 'detail' => 'Galaxy Trade LTD');
$fb_verification = '';
$showcase_url = 'https://nutralist.ru/showcase/JMyuQrZo';

$_debug = False; // установите True для вывода дополнительной информации для отладки и поиска ошибок
$pixels = [
    'fb_pixel', 'fb_verify', 'google_pixel', 'google_adw_pixel', 'tiktok_pixel', 'topmail_pixel', 'vk_pixel', 
    'yandex_metrika', 'mail_pixel', 'bigo_pixel'
];

if(!$apiKey){
    echo 'Ключ доступа к API не определен. Получите в личном кабинете или обратитесь в службу поддержки';
    die;
}

if(!$offer_id){
    echo 'ID оффера не определен';
    die;
}


/**
 * Настройки валидации полей формы.
 *
 * Для активации настройки нужно раскомментировать нужную строку и поставить нужное значение.
 *
 * Пример:
 * Длина телефонного номера (только цифры) должна быть от 9 до 12 цифр.
 *
 * $formValidatorOptions = [
 *     'phone_min_length' => 9,
 *     'phone_max_length' => 12,
 * ];
 */
$formValidatorOptions = [
    # Отключить маску телефонного номера (код страны) по умолчанию
    #'disable_phone_mask' => true,

    # Минимальная длина телефонного номера (считаются только цифры)
    #'phone_min_length' => 7,

    # Максимальная длинателефонного номера (считаются только цифры)
    #'phone_max_length' => 15,
];


/**
 * Конверсионные элементы для лендинга.
 *
 * Для подключения конверсионного элемента его необходимо внести в массив $plugins. Где ключ - название конверсионного
 * элемента, а значение массив с необходимыми параметрами, если параметры не нужны - пустой массив.
 *
 * Пример:
 * $plugins = [
 *      'online_visitors_top' => [],
 *      'delivery' => [],
 *      'promocode' => ['promocode' => 'super'],
 *      'popup' => ['timeout' => 15],
 * ];
 *
 * Для активации элемента раскомментируйте строку в массиве $plugins, который объявлен ниже.
 * Параметры установлены по умолчанию.
 */

$plugins = [
#    'corona_delivery_top' => [],
#    'corona_delivery_eng_top' => [],
#    'online_visitors_top' => [],
#    'quick_order' => [],
#    'promocode' => ['promocode' => 'sale'],
#    'online_visitors' => [],
#    'made_order' => [],
#    'delivery' => [],
#    'freeze_price' => [],
#    'recall' => ['timeout' => 10],
#    'popup' => ['timeout' => 20],
#    'sale_11_ru_top' => [],
#    'black_friday_ru_top' => [],
#    'black_friday_eng_top' => [],
#    'christmas_sale_ru_top' => [],
#    'christmas_sale_eng_top' => [],
#    'valentines_day_ru_top' => [],
#    'valentines_day_eng_top' => [],
#    'march_8_top' => [],
];

/**
 * Из элементов 'corona_delivery_top', 'corona_delivery_eng_top', 'online_visitors_top' одновременно можно
 * выбрать только один. То же самое с элементами 'quick_order', 'promocode'.
 *
 * Элементы у которых доступны все языки, язык зависит от значения переменной $language.
 *
 *
 * Описание конверсионных элементов:
 *
 * 'corona_delivery_top' - Бесконтактное вручение (в условиях вируса).
 * Сверху лендинга отображается информация о бесконтактной доставке. Все языки.
 *
 * 'corona_delivery_eng_top' - Бесконтактное вручение (в условиях вируса).
 * Сверху лендинга отображается информация о бесконтактной доставке на английском. Только английский язык.
 *
 * 'online_visitors_top' - Плашка в шапке "посетители онлайн".
 * Сверху лендинга отображаются показатели продаж и посетителей за день. Все языки.
 *
 * 'quick_order' - Форма быстрого заказа. Закрепленная внизу экрана строка для быстрого заказа. Все языки.
 *
 * 'promocode' - Промо-код. Форма для ввода промокода для получения скидки. Все языки.
 * Необходимо указать значение промокода. Пример: 'promocode' => ['promocode' => 'super']
 *
 * 'online_visitors' - Поплавок "просматривают сейчас сайт".
 * Окошко сбоку с показателями, сколько посетителей сейчас на сайте. Все языки.
 *
 * 'made_order' - Поплавок сделавших заказ справа. Всплывающее каждые 30 секунд окошко о клиентах, оформивших заказ.
 * Только русский язык.
 *
 * 'delivery' - Информация о доставке. Всплывающая плашка с информацией о доставке по ГЕО клиента. Все языки.
 *
 * 'freeze_price' - Мы заморозили цену. Закрепленное справа окошко с "замороженным" курсом доллара. Только русский язык.
 *
 * 'recall' - Кнопка "Перезвоните мне". Через заданное время внизу лендинга появляется кнопка "Перезвонить". Все языки.
 * Необходимо указать время в секундах. Пример: 'recall' => ['timeout' => 10]
 *
 * 'popup' - Попап после открытия ленда в секундах. Через заданное время появляется попап с формой заказа. Все языки.
 * Необходимо указат время в секундах. Пример: 'popup' => ['timeout' => 20]
 *
 * 'sale_11_ru_top' - Вверху лендинга появляется баннер 'Всемирный День Шопинга'. Только русский язык.
 *
 * 'black_friday_ru_top' - Вверху лендинга появляется баннер 'Черная пятница'. Русский язык.
 *
 * 'black_friday_eng_top' - Вверху лендинга появляется баннер 'Black friday'. Английский язык.
 *
 * 'christmas_sale_ru_top' - Вверху лендинга появляется баннер 'Новогодняя распродажа'. Русский язык.
 *
 * 'christmas_sale_eng_top' - Вверху лендинга появляется баннер 'Christmas sale'. Английский язык.
 * 
 * 'valentines_day_ru_top' - Вверху лендинга появляется баннер 'Большая распродажа ко Дню всех влюбленных!' Русский язык.
 *
 * 'valentines_day_eng_top' - Вверху лендинга появляется баннер 'St. Valentine's Day Sale'. Английский язык.
 * 
 * 'march_8_top' - Вверху лендинга появляется баннер 'Распродажа к 8 марта!' или 'Распродажа для милых дам!' Русский язык.
 */
