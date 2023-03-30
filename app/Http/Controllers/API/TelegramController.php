<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendTelegramMessages;
use Illuminate\Support\Facades\Notification;

class TelegramController extends Controller
{
    public function send(Request $request)
    {
        $input = $request->all();
        try {
            $app = User::where('api_key', $input['app_key'])->first();
            return Notification::route('telegram', $app->telegram_chat_id)->notify(new SendTelegramMessages($input['message']));
        } catch (\Throwable $e) {
            return response($e->getMessage());
        }
    }
}
