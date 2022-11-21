<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
  public $timestamps  = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id_user','position'];

  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }
}