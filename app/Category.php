<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public function course()
    {
        return $this->belongsTo('App\Course','category_id');
    }
}