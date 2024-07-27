<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'chat_name',
        'chat_id',
        'is_done',
        'is_deleted',
        'is_archived',
        'message_id'
    ];

    public function done($chat_id, $message_id)
    {
        $telegram_api_token = env('TELEGRAM_API_TOKEN');
        $text = "Задача выполнена";

        $client = new Client();

        $url = "https://api.telegram.org/bot{$telegram_api_token}/sendMessage";

        $params = [
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_to_message_id' => $message_id,
            'parse_mode' => 'HTML'
        ];

        try {
            $response = $client->post($url, [
                'json' => $params
            ]);

            if ($response->getStatusCode() == 200) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            \Log::error("Ошибка при отправке сообщения в Telegram: " . $e->getMessage());
            return false;
        }
    }

    public function archived($chat_id, $message_id)
    {
        $telegram_api_token = env('TELEGRAM_API_TOKEN');
        $text = "Задача разархивирована ждите подтверждения. Подтверждение займет до 48 часов.";

        $client = new Client();

        $url = "https://api.telegram.org/bot{$telegram_api_token}/sendMessage";

        $params = [
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_to_message_id' => $message_id,
            'parse_mode' => 'HTML'
        ];

        try {
            $response = $client->post($url, [
                'json' => $params
            ]);

            if ($response->getStatusCode() == 200) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            \Log::error("Ошибка при отправке сообщения в Telegram: " . $e->getMessage());
            return false;
        }
    }
}
