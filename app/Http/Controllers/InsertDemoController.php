<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;

class InsertDemoController extends Controller
{
    public function index()
    {
        $workers = Worker::orderBy('created_at', 'desc')->paginate(5);
        return view('insert.index')->with('workers', $workers);
    }

    public function confirm(\App\Http\Requests\InsertDemoRequest $request)
    {
        $data = $request->all();
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
        return view('insert.finish');
    }
}
