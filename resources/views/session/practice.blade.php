@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center p-lg-5 bg-light">
        アクセスカウンター<span class="h1 text-danger">{{ $count }}</span>
        <br>
        <br>
        <!-- route('session.index') でもよい -->
        <a class="btn btn-primary btn-lg text-white" href="{{ url('session/index') }}">リロード</a>
        <br>
        <br>
        <!-- route('session.reset') でもよい -->
        <a class="btn btn-danger btn-lg text-white" href="{{ url('session/reset') }}">セッション削除</a>
    </div>
@endsection
