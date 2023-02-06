<?php

/*
hi484690.ftp.tools
hi484690_ftp
1g6EYrs7f1
*/

// быстрая отправка (сжать изображение)
require_once __DIR__ . '/config.php';

function debug($data)
{
    echo '<pre>' . print_r($data, true) .  '</pre>';
}

$url = BASE_URL . 'getUpdates';
$res = json_decode(file_get_contents($url));
//debug($res);
//echo $res->result->id;
//echo $res['result']['id'];

if (!empty($res->result)) {
    foreach ($res->result as $update) {
        $text = "<b><i>Вы написали:</i></b> <i>{$update->message->text}</i>";
        echo $text . PHP_EOL;
        $url = BASE_URL . "sendMessage?chat_id={$update->message->chat->id}&text={$text}&parse_mode=HTML";
        file_get_contents($url);
    }
}

