<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NewUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\TelegramUpdates;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $data = Auth::user()->api_key;
            return view('home', compact('data'));
        } catch (\Throwable $e) {
            dd($e);
        }
    }
}
