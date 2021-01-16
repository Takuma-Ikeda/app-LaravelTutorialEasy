<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsertDemoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PracticeSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * answer_01.md
 */

// 入力画面
Route::get('insert/', [
    InsertDemoController::class,
    'index'
])->name('insert.index');

// 確認画面
Route::post('insert/confirm/', [
    InsertDemoController::class,
    'confirm'
])->name('insert.confirm');

// 完了画面
Route::post('insert/finish', [
    InsertDemoController::class,
    'finish'
])->name('insert.finish');

/**
 * answer_02.md
 */

Auth::routes();

Route::get('/home', [
    HomeController::class,
    'index'
])->name('home');

/**
 * answer_03.md
 */

// Route::get('/student/list', [
//     StudentController::class,
//     'index'
// ])->name('student.list');

Route::group(['prefix' => 'student'], function () {
    // 一覧
    Route::get('list', [
        StudentController::class,
        'index'
    ])->name('student.list');
    // 新規: get
    Route::get('new', [
        StudentController::class,
        'new_index'
    ])->name('student.new_index');
    // 新規確認: patch
    Route::patch('new', [
        StudentController::class,
        'new_confirm'
    ])->name('student.new_confirm');
    // 新規完了: post
    Route::post('new', [
        StudentController::class,
        'new_finish'
    ])->name('student.new_finish');
    // 編集: get
    Route::get('edit/{id}/', [
        StudentController::class,
        'edit_index'
    ])->name('student.edit_index');
    // 編集確認: patch
    Route::patch('edit/{id}/', [
        StudentController::class,
        'edit_confirm'
    ])->name('student.edit_confirm');
    // 編集完了: post
    Route::post('edit/{id}/', [
        StudentController::class,
        'edit_finish'
    ])->name('student.edit_finish');
    // 削除: post
    Route::post('delete/{id}/', [
        StudentController::class,
        'delete'
    ])->name('student.delete');
});

/**
 * answer_04.md
 */

Route::group(['prefix' => 'session'], function () {
    Route::get('index', [
        PracticeSessionController::class,
        'index'
    ])->name('session.index');

    Route::get('reset', [
        PracticeSessionController::class,
        'reset'
    ])->name('session.reset');
});
