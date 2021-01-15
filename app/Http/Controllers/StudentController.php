<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $req)
    {
        //キーワード受け取り
        $keyword = $req->input('keyword');
        //クエリ生成
        $query = Student::query();
        //もしキーワードがあったら
        if (!empty($keyword)) {
            $query->where(
                'email',
                'like',
                '%' . $keyword . '%'
            )->orWhere(
                'name',
                'like',
                '%' . $keyword . '%'
            );
        }
        //ページネーション
        $students = $query->orderBy('id', 'desc')->paginate(10);
        return view('student.list')->with('students', $students)->with('keyword', $keyword);
    }

    /**
     * new
     */

    public function new_index()
    {
        return view('student.new_index');
    }

    public function new_confirm(\App\Http\Requests\StudentRequest $req)
    {
        $data = $req->all();
        return view('student.new_confirm')->with($data);
    }

    // 引数の型は StudentRequest でもよいが、確認画面でバリデーションはかけたので Request クラスを使用
    public function new_finish(Request $req)
    {
        // Studentオブジェクト生成
        $student = new Student();
        // 値の登録
        $student->name  = $req->name;
        $student->email = $req->email;
        $student->tel   = $req->tel;
        // 保存
        $student->save();
        // フラッシュメッセージ
        $req->session()->flash('message', '登録が完了いたしました。');
        // リダイレクト
        return redirect()->to('student/list');
    }

    /**
     * edit
     */

    public function edit_index($id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit_index')->with('student',$student);
    }

    public function edit_confirm(\App\Http\Requests\StudentRequest $req)
    {
        $data = $req->all();
        return view('student.edit_confirm')->with($data);
    }

    public function edit_finish(Request $req, $id)
    {
        //レコードを検索
        $student = Student::findOrFail($id);
        //値を代入
        $student->name  = $req->name;
        $student->email = $req->email;
        $student->tel   = $req->tel;
        //保存（更新）
        $student->save();
        // フラッシュメッセージ
        $req->session()->flash('message', '更新が完了いたしました。');
        //リダイレクト
        return redirect()->to('student/list');
    }

    /**
     * delete
     */

    public function delete($id){
        //削除対象レコードを検索
        $user = Student::find($id);
        //削除
        $user->delete();
        //リダイレクト (フラッシュメッセージ付き)
        return redirect()->to('student/list')->with('message', '削除が完了いたしました。');
    }
}

