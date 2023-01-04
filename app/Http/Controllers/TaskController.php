<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Team;
use App\Models\Task;

class TaskController extends Controller
{

    protected function validation()
    {
        return  [
          'title' => ['required','string'],
          'description' => ['required','string'],
        ];
    }
    /**
     * Shows the task for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function showTask($id)
    {
      $task = Task::find($id);
      $this->authorize('show', $task);
      return view('pages.task', ['task' => $task]);
    }

    /**
     * Shows all tasks.
     *
     * @return Response
     */
    public function showTasks($id)
    {
      if (!Auth::check()) return redirect('/login');
      //$this->authorize('list', Task::class);
      $tasksToDo = Task::where('task.id_team', $id)->where('task.task_status', 'To Do')->get();
      $tasksInProgress = Task::where('task.id_team', $id)->where('task.task_status', 'In Progress')->get();
      $tasksCompleted = Task::where('task.id_team', $id)->where('task.task_status', 'Completed')->get();

      //Team::find($id)->tasks()->orderBy('id_task')->get();
      //return $tasks;
      return view('pages.cards', ['tasksToDo' => $tasksToDo, 'tasksInProgress' => $tasksInProgress, 'tasksCompleted' => $tasksCompleted]);
    
    }

    /**
     * Creates a new task.
     *
     * @return Card The task created.
     */
    public function create(Request $request)
    {
      $task = new Task();

      $this->authorize('create', $task);

      $card->name = $request->input('name');
      $card->user_id = Auth::user()->id;
      $card->save();

      return $card;
    }

    public function updateTask(int $id, Request $request)
    {
      Gate::authorize('update',Task::find($id));
      
      if($request->input('action') == 'deltask'){
        $task = Task::find($id);
        $task->delete();
      }
      
      
      return response()->json(['success'=>'User Deleted Successfully!']);
    }
   
}
