<?php

namespace App\Http\Controllers;

use App\Folder;
// これ必要
use App\Http\Requests\CreateTask;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    public function index(int $id)
    { 
         //  ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選択されたフォルダを取得する
        $current_folder = Folder::find($id);


        // 選択されたフォルダに紐づくタスクを取得する
        $tasks = $current_folder->tasks()->paginate(3);


        // ここでviewに渡す準備をする
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create',[
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function  showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        $task = Task::find($task_id);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index',[
            'id' => $task->folder_id
        ]);
    }
    
}
