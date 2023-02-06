<?php

set_time_limit(0);

require_once __DIR__ . '/config.php';

function debug($data)
{
    echo '<pre>' . print_r($data, true) .  '</pre>';
}

function sendRequest($method, $params = [])
{
    $url = BASE_URL . $method;
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }
    return json_decode(file_get_contents($url));
}

while (true) {
    $params = [];
    if (isset($last_update)) {
        $params = [
            'offset' => $last_update + 1,
        ];
    }
    $res = sendRequest('getUpdates', $params);

    if (!empty($res->result)) {
        foreach ($res->result as $update) {
            $text = "<b><i>Вы написали:</i></b> <i>{$update->message->text}</i>";
            echo $text . PHP_EOL;
            $last_update = $update->update_id;
            sendRequest('sendMessage', [
                'chat_id' => $update->message->chat->id,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        }
    }
    sleep(3);
}
