<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskCommentsController extends Controller
{
    public static function getTaskComments($id_task) {
        return TaskComment::where('id_task','=',$id_task)->orderByDesc('created_at')->paginate(7);
    }

    public function sendComment($id_task, Request $request) {

        Gate::authorize('update',Task::find($id_task));
        $task_comment = new TaskComment();

        $task_comment->id_user = Auth::id();
        $task_comment->id_task = $id_task;
        $task_comment->comment = $request->comment;
        $task_comment->created_at = now();

        $task_comment->save();

        return redirect()->back();
    }
}