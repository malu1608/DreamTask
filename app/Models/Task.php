<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public $timestamps  = false;
  protected $primaryKey = 'id_task';
  protected $table = 'task';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'description', 'task_status', 'id_team'
  ];


  public function project()
  {
    return $this->belongsTo(Project::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function notifications()
  {
    return $this->hasMany(Notification::class);
  }

  public function members()
  {
    return $this->belongsToMany(TeamMember::class);
  }

  public function team()
  {
    return $this->belongsTo(Team::class,'id_team');
  }

}