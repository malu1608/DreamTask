<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  public $timestamps  = false;
  protected $primaryKey = 'id_project';
  protected $table = 'project';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'description', 'company','project_status','creation_date','current_edit_date'
  ];

  public function notifications()
  {
    return $this->hasMany(Notification::class);
  }

  public function members()
  {
    return $this->belongsToMany(User::class);
  }

  public function teams()
  {
    return $this->hasMany(Team::class);
  }

}