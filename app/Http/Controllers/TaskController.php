<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Project;
use App\Models\Team;
use App\Models\Task;
use App\Models\TeamMember;

use Validator;

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
      $team = Team::where('id_team', '=', $id)->first();
      $project = Project::where('project.id_project', '=', $team->id_project)->first();
      //Team::find($id)->tasks()->orderBy('id_task')->get();
      //return $tasks;

      $teams = Team::join('project', 'project.id_project', 'team.id_project')
                    ->where('team.id_team', '=', $id)
                    ->get();


      return view('pages.cards', ['tasksToDo' => $tasksToDo, 'tasksInProgress' => $tasksInProgress, 'tasksCompleted' => $tasksCompleted, 'team_id' => $id, 'project' => $project, 'teams' => $teams]);
    
    }

    /**
     * Creates a new task.
     *
     * @return Task The task created.
     */
    public function create(Request $request)
    {
      $validator = Validator::make($request->all(), [ 
        'title' => ['required','string'],
        'description' => ['required','string'],
        'task_status' => ['required','string'],
        'id_team' => ['required','integer'],
      ]);

      if ($validator->fails()) {
          return redirect()->back();
      }

      $is_able = TeamMember::where('id_user', '=', Auth::user()->id_user)
                  ->where('id_team', '=', $request['id_team'])
                  ->where('is_coordinator', true)
                  ->exists();

      if (!$is_able) return redirect()->back();

      $task = new Task();

      $task->title = $request['title'];
      $task->description = $request['description'];
      $task->creation_date = now();
      $task->task_status = $request['task_status'];
      $task->id_team = $request['id_team'];

      $task->save();

      return redirect()->back();
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
