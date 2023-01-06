<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  public $timestamps  = false;
  protected $primaryKey = 'id_team';
  protected $table = 'team';

  /**
   * For mass assignes.
   *
   * @var array
   */
  protected $fillable = ['name', 'field', 'id_project'];


  public function project()
  {
    return $this->belongsTo(Project::class, 'id_project');
  }

  public function tasks()
  {
    return $this->hasMany(Task::class, 'id_task');
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function members()
  {
    return User::join('member_team', 'member_team.id_user', 'users.id_user')
    ->where('member_team.id_team', '=', $this->id_team)
    ->get();
    // return $this->belongsToMany(User::class);

  }

}