<?php

namespace App\Http\Controllers;


use App\Models\Notification;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
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

    static function getNotifications($id)
    {
        $my_notifications = Notification::where('id_user','=',$id)->orderByDesc('created_at')->get();
        return $my_notifications;
    }


    public function taskClosedNotification($id) {
        $notification = Notification::find($id);
        $notification->save();
        $task = Task::find($notification->id_task);
        return redirect('/project/'.$task->project_id.'/task/'.$task->id);
    }

    public function assignNotification($id) {
        $notification = Notification::find($id);
        $notification->save();
        $task = Task::find($notification->id_task);
        return redirect('/project/'.$task->id_project.'/task/'.$task->id);
    }


}
