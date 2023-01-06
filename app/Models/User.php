<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $primaryKey = 'id_user';
    public $table = 'users';

    protected $redirectTo = '/';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'first_name', 'last_name', 'email', 'description', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    /**
     * User belongs to many projects.
     */
    public function projects() {
        return $this->belongsToMany('App\Models\Project');
      }


     /**
     * User belongs to many teams.
     */
    public function teams() {
        return $this->belongsToMany('App\Models\Team');
      }

    /**
     * User can be a team member.
     */
    public function teamMember() {
        return $this->belongsTo('App\Models\TeamMember');
      }

    public function isAdmin() {
      return $this->is_admin;
    }    
    
    public function getName() {
      
      return $this->first_name . " " . $this->last_name;
    }

    public function isCoordinator($team_id) {
      return TeamMember::where('member_team.id_user', '=', $this->id_user)
                  ->where('member_team.id_team', '=', $team_id)
                  ->where('member_team.is_coordinator', true)
                  ->exists();
    }
}
