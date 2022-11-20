<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  public $timestamps  = false;


  /**
   * For mass assignes.
   *
   * @var array
   */
  protected $fillable = ['notification_type', 'id_project', 'id_task', 'id_comment'];


  public function project()
  {
    return $this->belongsTo(Project::class, 'id_project');
  }

  public function task()
  {
    return $this->belongsTo(Task::class, 'id_task');
  }

  public function comment()
  {
    return $this->belongsTo(Comment::class, 'id_comment');
  }
}