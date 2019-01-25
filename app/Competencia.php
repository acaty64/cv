<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable =    [   
    		'user_id',
            'titulo',
            'yini',
            'yfin',
            'documento',
            'verificado'
        ];

    public function getUserAttribute()
    {
    	return User::findOrFail($this->user_id);
    }

}
