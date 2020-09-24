<?php
    include 'db.php';

    // Принимаем запрос
    $data = json_decode(file_get_contents('php://input'), TRUE);
    file_put_contents('update.txt', '$data: ' . print_r($data, 1)."\n", FILE_APPEND);
 
    // Обрабатываем ручной ввод или нажатие на кнопку
    $data = $data['callback_query'] ? $data['callback_query'] : $data['message'];
    $chat_id = $data['from']['id'];
    $fullName = $data['from']['first_name'] . ' ' . $data['from']['last_name'];

    // Важные константы
    define('TOKEN', 'token');

    // Записываем сообщение пользователя
    $message = mb_strtolower(($data['text'] ? $data['text'] : $data['data']), 'utf-8');

    $keyboard = [
        'keyboard'=>[
            [['text'=>'Гласные'],['text'=>'Согласные']] // Первый ряд кнопок
        ]
    ];

    $keyboardVowelsRange = [
        'keyboard'=>[
            [['text'=>'Гласные. Период: Последнее сообщение.']],
            [['text'=>'Гласные. Период: Последние 10 сообщений.']]
        ]
    ];

    $keyboardConsonantsRange = [
        'keyboard'=>[
            [['text'=>'Cогласные. Период: Последнее сообщение.']],
            [['text'=>'Cогласные. Период: Последние 10 сообщений.']]
        ]
    ];
    
    switch($message){
        case '/start':
            $method = 'sendMessage';
            $send_data = [
                'method' => 'sendMessage',
                'text' => 'Для отображения интерфейса введите: "Кнопки".'
            ];
        break;
        case 'кнопки':
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Вот мои кнопки',
                'reply_markup' => json_encode($keyboard)
            ];
        break;

        case 'гласные':
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Вот мои кнопки',
                'reply_markup' => json_encode($keyboardVowelsRange)
            ];
        break;

        case 'согласные':
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Вот мои кнопки',
                'reply_markup' => json_encode($keyboardConsonantsRange)
            ];
        break;

        case 'гласные. период: последнее сообщение.':
            $answer = VowelsPeriodOne($chat_id);
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Статистика за: Последнее сообщение.
Количество гласных букв: '.$answer . '.',
            ];
        break;

        case 'гласные. период: последние 10 сообщений.':
            $answer = VowelsPeriodTen($chat_id);
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Статистика за: 10 сообщений.
Количество гласных букв: '.$answer . '.',
            ];
        break;

        case 'cогласные. период: последнее сообщение.':
            $answer = ConsonantsPeriodOne($chat_id);
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Статистика за: Последнее сообщение.
Количество согласных букв: '.$answer . '.',
            ];
        break;

        case 'cогласные. период: последние 10 сообщений.':
            $answer = ConsonantsPeriodTen($chat_id);
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Статистика за: 10 сообщений.
Количество согласных букв: '.$answer . '.',
            ];
        break;

        case 'gg':
            $method = 'sendMessage';
            $send_data = [
                'method' => 'sendMessage',
                'text' => 'wp'
            ];
        break;

            
        default:
            $reply = CheckUser($chat_id, $fullName, $message);
            $method = 'sendMessage';
            $send_data = [
                'method' => 'sendMessage',
                'text' => $reply
            ];
    }

    $send_data['chat_id'] = $data['chat']['id'];
    $res = sendTelegram($method, $send_data);


    // Функция вызова методов API.
    function sendTelegram($method, $response)
    {
        $ch = curl_init('https://api.telegram.org/bot' . TOKEN . '/' . $method);  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);
    
        return $res;
    }