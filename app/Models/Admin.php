<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  public $timestamps  = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id_admin'];

  public function user()
  {
    return $this->belongsTo(User::class, 'id_admin');
  }

}