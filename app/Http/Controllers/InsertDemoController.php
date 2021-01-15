<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;

class InsertDemoController extends Controller
{
    public function index()
    {
        $workers = Worker::orderBy('created_at', 'desc')->paginate(5);
        // resources/views/insert/index.blade.php
        return view('insert.index')->with('workers', $workers);
    }

    public function confirm(\App\Http\Requests\InsertDemoRequest $request)
    {
        $data = $request->all();
        // resources/views/insert/confirm.blade.php
        return view('insert.confirm')->with($data);
    }

    public function finish(\App\Http\Requests\InsertDemoRequest $request)
    {
        // Worker モデルのインスタンスを作成
        $worker = new Worker();
        $worker->username = $request->username;
        $worker->mail     = $request->mail;
        $worker->age      = $request->age;
        $worker->save();
        // resources/views/insert/finish.blade.php
        return view('insert.finish');
    }
}
