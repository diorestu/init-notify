<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\UserLog;
use Throwable;

class UserLogController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar User Log';
        $data['user_log'] = UserLog::all();
        return view('user-log.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah User Log';
        return view('user-log.create', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'logs' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            UserLog::create($data);
            DB::commit();
            return redirect()->route('user-log.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('UserLogController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['title'] = 'Detail User Log';
        $data['user_log'] = UserLog::find($id);
        return view('user-log.show', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit User Log';
        $data['user_log'] = UserLog::find($id);
        return view('user-log.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'logs' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            UserLog::find($id)->update($data);
            DB::commit();
            return redirect()->route('user-log.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('UserLogController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            UserLog::find($id)->delete();
            DB::commit();
            return redirect()->route('user-log.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('UserLogController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
