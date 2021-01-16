<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticeSessionController extends Controller
{
    public function index()
    {
        // セッション値「count」の存在確認
        if (session()->has('count')) {
            $count = session('count');
        } else {
            $count = 0;
        }
        // カウントを 1 増やす
        $count++;
        // session にキーワード count で値を保存
        session(['count' => "$count"]);
        // with('count', $count) でもよいが、compact('count') の方がシンプル
        return view("session.practice", compact('count'));
    }

    public function reset()
    {
        // セッション削除
        session()->forget('count');
        return redirect('session/index');
    }
}
