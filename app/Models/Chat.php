<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
class Chat extends Model
{
    use HasFactory;
    protected $fillable = ['chat_id', 'name'];

    public function sendTelegramMessage($message_text, $chat_id)
    {
        $telegramApiToken = env('TELEGRAM_API_TOKEN');
        $url = "https://api.telegram.org/bot{$telegramApiToken}/sendMessage";

        $client = new Client();

        $params = [
            'chat_id' => $chat_id,
            'text' => $message_text,
            'parse_mode' => 'HTML',
        ];

        Log::error("Telegram API request: " . json_encode($params));

        try {
            $response = $client->post($url, [
                'json' => $params
            ]);

            // Check if the response status is OK
            if ($response->getStatusCode() == 200) {
                return true;
            } else {
                Log::error("Telegram API response error: " . $response->getBody()->getContents());
                return false;
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error("Error sending message to Telegram: " . $e->getMessage());
            return false;
        }
    }
}
