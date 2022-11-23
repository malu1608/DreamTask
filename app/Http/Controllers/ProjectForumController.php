<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectForumController extends Controller
{
    function show($id) {
        $project = Project::find($id);
        Gate::authorize('notGuestOrAdmin',$project);
        $user = Auth::user();
        $notifications = NotificationsController::getNotifications(Auth::id());
        $messages = ProjectMessage::where('id_project','=',$id)->orderByDesc('created_at')->paginate(7);
        $project_member = ProjectMember::find(['id_user' => $user->id,'id_project' => $project->id]);
        return view('pages.projectForum',['project' => $project, 'notifications' => $notifications,'messages' => $messages,'user_role' => $user_role]);
    }

    function sendMessage($id, Request $request) {
        Gate::authorize('isActive',Project::find($id));
        $message = new ProjectMessage();

        $message->id_user = Auth::id();
        $message->id_project = $id;
        $message->message = $request->message;
        $message->created_at = now();

        $message->save();

        return redirect()->back();
    }
}
