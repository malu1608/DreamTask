<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model{

    public $timestamps  = false;

    protected $table = 'taskcomments';

    protected $fillable = [
        'comment', 'id_task', 'id_user'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

}