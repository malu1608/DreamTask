<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public $timestamps  = false;

  /**
   * For mass assignes.
   *
   * @var array
   */
  protected $fillable = ['content', 'id_user', 'id_task', 'id_team', 'comment'];


  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }

  public function task()
  {
    return $this->belongsTo(Task::class, 'id_task');
  }

  public function team()
  {
    return $this->belongsTo(Team::class, 'id_team');
  }

  public function reply()
  {
    return $this->belongsTo(Comment::class, 'comment');
  }

  public function notifications()
  {
    return $this->hasMany(Notification::class);
  }

}