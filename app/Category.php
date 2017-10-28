<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


 /**
     * Get all of the skills for the category.
     */
    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

}
