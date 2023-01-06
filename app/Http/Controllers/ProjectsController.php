<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ProjectsController extends Controller
{
    protected function validation()
    {
        return  [
            'name' => 'required|string|max:64',
            'description' => 'required|string|max:255',
            'company' => 'string|max:64',
        ];
    }


    public function projectForm()
    {
        return view('pages.projectsCreate');
    }


    protected function create(Request $request)
    {
        $validator = $request->validate($this->validation());

        $project = new Project;

        $project->name = $request->name;
        $project->description = $request->description;
        $project->company = $request->company;

        $project->save();

        return redirect("/projects");
    }
 /*
    public function showProjectsLists($id){
        if (!Auth::check()) return redirect('/login');
        $projectToDo = Project::where('project.id_project', $id)->where('project.project_status', 'To Do')->get();
        //echo $projectToDo;
        $projectInProgress = Project::where('project.id_project', $id)->where('project.project_status', 'In Progress')->get();
        //echo $projectInProgress;
        $projectCompleted = Project::where('project.id_project', $id)->where('project.project_status', 'Completed')->get();
        //echo $projectCompleted;
        //$project_members = ProjectMember::where('id_user','=',Auth::id())->pluck('id_project');
        //$projects = Project::whereIn('id_project', $project_members->id_project);
        return view('pages.homeauthenticated', ['projectToDo' => $projectToDo, 'projectInProgress' => $projectInProgress, 'projectCompleted' => $projectCompleted]);
        
       
        $teams = Team::whereIn('id_project', $id_project)->get();
        $members = ProjectMember::whereIn('id_project', $id_project)->get();
        $teams = array($teams);
        $members = array($members);
         
        
    }
*/
    public function showAllProjects()
    {
        if (!Auth::check()) return redirect('/login');
        
        $projects = Project::all()->sortByDesc('current_edit_date');
        //echo $projects;
        
      return view('pages.homeauthenticated', ['projects' => $projects]);
    }

}