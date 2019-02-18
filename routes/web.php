<?php

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

Route::group(['middleware' => 'auth'], function() {
  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

  // 同じ URL で HTTP メソッド違いのルートがいくつかある場合はどれか一つに名前をつければ OK
  Route::get('/folders/create', 'ForderController@showCreateForm')->name('folders.create');
  Route::post('/folders/create', 'ForderController@create');

  // タスクの作成ページを表示
  Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
  // タスクの作成を実行
  Route::post('/folders/{id}/tasks/create', 'TaskController@create');

  // タスクの編集ページを表示
  Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
  // タスクの編集ページを表示
  Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');
  
  // Route::get('/folders/{id}/tasks/{task_id}/delete', 'TaskController@delete')->name('tasks.delete');
  // Route::get('/folders/{id}/tasks/search', 'TaskController@search')->name('tasks.search');

});



Auth::routes();
