<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasCompositePrimaryKey;
    public $timestamps  = false;

    protected $primaryKey = ['id_project','id_user'];
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'id_project', 'id_user',
    ];
}