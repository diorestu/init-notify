<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\SendTelegramMessages;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{

    public function index()
    {
        $data['title'] = 'Daftar Message';
        $data['message'] = Message::where('user_id', Auth::user()->id)->get();
        return view('message.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Message';
        return view('message.create', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();
            $data['user_id'] = Auth::user()->id;
            Message::create($data);
            Notification::route('telegram', Auth::user()->telegram_chat_id)->notify(new SendTelegramMessages($data['message']));
            DB::commit();
            return redirect()->route('message.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('MessageController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['title'] = 'Detail Message';
        $data['message'] = Message::find($id);
        return view('message.show', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Message';
        $data['message'] = Message::find($id);
        return view('message.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'messages' => 'required',
                'url' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            Message::find($id)->update($data);
            DB::commit();
            return redirect()->route('message.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('MessageController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Message::find($id)->delete();
            DB::commit();
            return redirect()->route('message.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('MessageController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
