<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
/*
==========================================
 タスク　コントローラー
==========================================
*/
class TaskController extends Controller
{


    /**
     * 一覧取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderByDesc('id')->get();
    }




    /**
     * 新規登録
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task( $request->all() );
        $task->save();

        return $task
            ? response()->json( $task, 201 )
            : response()->json( [],    500 )
        ;
    }




    /**
     * 更新
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        return $task->update( $request->all() )
            ? response()->json( $task )
            : response()->json( [], 500 )
        ;
    }




    /**
     * 削除
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        return $task->delete()
            ? response()->json( $task )
            : response()->json( [], 500 )
        ;
    }
}
