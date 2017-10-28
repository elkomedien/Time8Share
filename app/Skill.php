<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;


class Skill extends Model
{


    protected $fillable = ['name'];

/**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_skill');
    }

    /**
     *  The category of the skill
     */
    public function category()
     {
	return $this->belongsTo('App\Category');
     }

   
}
