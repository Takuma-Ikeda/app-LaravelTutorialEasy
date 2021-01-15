@extends('layouts.master_insert')
@section('title', 'Laravel チュートリアル（初級）')

@section('content')
    <div class="page-header" style="margin-top:-30px;padding-bottom:0px;">
        <h1>
            <small>受講生一覧</small>
        </h1>
    </div>

    <div class="row" style="margin-bottom: 30px;">
        <div class="col-sm-10" style="margin-bottom: 10px;">
            <form method="get" action="" class="form-inline">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" value="{{ $keyword }}" placeholder="検索キーワード">
                </div>
                <input type="submit" value="検索" class="btn btn-info">
            </form>
        </div>

        <div class="col-sm-2">
            <a href="{{ route('student.new_index') }}" class="btn btn-warning text-white">
                <i class="glyphicon glyphicon-plus"></i>新規登録
            </a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>name</th>
                <th>email</th>
                <th>tel</th>
                <th>operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->tel }}</td>
                    <td><a href="{{ route('student.edit_index', ['id' => $student->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
                    <td>
                        <form action=" {{ route('student.delete', ['id' => $student->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(Session::has('message'))
        <!-- モーダルウィンドウの中身 -->
        <!-- class="modal fade" は不具合で表示されない -->
        <div class="modal" id="modal_box" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">受講生 APP</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('message') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- page control -->
    {{-- {!! $students->render() !!} --}}
    {!! $students->appends(['keyword' => $keyword])->render() !!}

@endsection

@section('script')
    <script>
        $(function(){
            $(".btn-dell").click(function(){
                if (confirm("本当に削除しますか？")){
                    // そのまま submit（削除）
                } else {
                    // cancel
                    return false;
                }
            });
        });
    </script>

    @if(Session::has('message'))
        <script>
            $(window).load(function() {
                $('#modal_box').modal('show');
            });
        </script>
    @endif
@endsection
