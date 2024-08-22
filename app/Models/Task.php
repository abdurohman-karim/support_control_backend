<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


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

    public function done($chat_id, $message_id, $comment = null)
    {
        $telegram_api_token = env('TELEGRAM_API_TOKEN');
        $text = "Задача выполнена";

        $client = new Client();

        $url = "https://api.telegram.org/bot{$telegram_api_token}/sendMessage";

        $params = [
            'chat_id' => $chat_id,
            'text' => $text . "\n" . $comment,
            'reply_to_message_id' => $message_id,
            'parse_mode' => 'HTML'
        ];

        Log::error("Telegram API request: " . json_encode($params));

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
            Log::error("Ошибка при отправке сообщения в Telegram: " . $e->getMessage());
            return false;
        }
    }

    public function archived($chat_id, $message_id)
    {
        $telegram_api_token = env('TELEGRAM_API_TOKEN');
        $text = "Задача архивирована ждите подтверждения. Подтверждение займет до 48 часов.";

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
            Log::error("Ошибка при отправке сообщения в Telegram: " . $e->getMessage());
            return false;
        }
    }

    public function unzip($chat_id, $message_id)
    {
        $telegram_api_token = env('TELEGRAM_API_TOKEN');
        $text = "Задача разархивирована.";

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
            Log::error("Ошибка при отправке сообщения в Telegram: " . $e->getMessage());
            return false;
        }
    }

    public function updateChatName()
    {
        $telegram_api_token = env('TELEGRAM_API_TOKEN');
        $chatId = $this->chat_id;

        if (empty($chatId)) {
            Log::error('Chat ID is empty for task ID ' . $this->id);
            return;
        }

        $url = "https://api.telegram.org/bot{$telegram_api_token}/getChat";

        try {
            $response = Http::get($url, [
                'chat_id' => $chatId
            ]);

            $data = $response->json();

            if (!$data['ok']) {
                Log::error('Error fetching chat name from Telegram API: ' . $data['description']);
                return;
            }

            if (isset($data['result']['title'])) {
                $newChatName = $data['result']['title'];
                if ($this->chat_name !== $newChatName) {
                    DB::table('tasks')
                        ->where('chat_id', $chatId)
                        ->update(['chat_name' => $newChatName]);
                    $this->chat_name = $newChatName; // Update the current instance as well
                }
            }
        } catch (\Exception $e) {
            Log::error('Exception fetching chat name: ' . $e->getMessage());
        }
    }
}
