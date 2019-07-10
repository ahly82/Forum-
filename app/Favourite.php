<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $primaryKey = 'id' ;
    protected $fillable = ['user_id','favourited_id','favourited_by'];
}
