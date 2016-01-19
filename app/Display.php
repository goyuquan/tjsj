<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    protected $fillable = ['name','parent_id'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

}
