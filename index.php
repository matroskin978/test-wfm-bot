<?php

// быстрая отправка (сжать изображение)
require_once __DIR__ . '/config.php';

function debug($data)
{
    echo '<pre>' . print_r($data, true) .  '</pre>';
}

const BASE_URL = 'https://api.telegram.org/bot' . TOKEN . '/';
$url = BASE_URL . 'getMe';
$res = json_decode(file_get_contents($url), true);
debug($res);
//echo $res->result->id;
echo $res['result']['id'];
