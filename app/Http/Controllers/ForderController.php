<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

//これが必要だった
use App\Folder;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;

class ForderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;

        // ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);
        
        // tasks.indexの名前付きルートに飛ばして変数部分にフォルダーのidいれる
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
