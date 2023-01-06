<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasCompositeprimaryKey;

class TeamMember extends Model
{
  public $timestamps  = false;
  protected $primaryKey = ['id_user','id_team'];
  public $incrementing = false;
  public $table = 'member_team';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id_user','position'];

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'id_user');
  }

  public function isCoordinator() {
    return $this->is_coordinator;
  }

  
}