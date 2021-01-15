@extends('layouts.master_insert')
@section('title', 'Laravel チュートリアル（初級）')

@section('content')
    <h3>完了画面</h3>
    <p>入力画面 -> 確認画面 -> <span class="label label-danger">完了画面</span></p>
    <div class="alert alert-success" role="alert">データベースにデータを挿入しました！</div>

    <div class="col-sm-offset-2 col-sm-10 text-center">
        <a href="{{ route('insert.index') }}" class="btn btn-primary btn-wide">TOPへ</a>
    </div>
@endsection
