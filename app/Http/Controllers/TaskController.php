<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Team;
use App\Models\Task;

class TaskController extends Controller
{
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
      $tasks = Task::where('task.id_team', $id)->get();
      //Team::find($id)->tasks()->orderBy('id_task')->get();
      //return $tasks;
      return view('pages.cards', ['tasks' => $tasks]);
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

    public function delete(Request $request, $id)
    {
      $card = Card::find($id);

      $this->authorize('delete', $card);
      $card->delete();

      return $card;
    }
}
