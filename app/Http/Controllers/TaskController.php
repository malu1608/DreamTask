<?php

namespace App\Http\Controllers;

use App\Models\ProjectMember;
use App\Models\Task;
use App\Models\Project;
use App\Models\TaskComment;
use App\Models\Notification;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator()
    {
        return  [
            'title' => ['required','string'],
            'description' => ['required','string'],
        ];
    }

    public function taskForm()
    {
        return view('pages.tasksCreate');
    }


    protected function create(Request $request)
    {
        $validator = $request->validate($this->validation());

        $task = new Task;

        $task->title = $request->title;
        $task->description = $request->description;

        $task->save();

        return redirect("/tasks");
    }


    public function showTask(int $id_project, int $id_task)
    {
        $task = Task::findOrFail($id_task);
        Gate::authorize('show',$task);
        $members = ProjectMember::whereIn('id_project', $id_project)->get();
        $taskComments = TaskCommentsController::getTaskComments($id);
        $teams = array($teams);
        $members = array($members);
        return view('pages.task',['project' => $project, 'task' => $task, 'members' => $members, 'task_comments' => $taskComments]);
    }


  