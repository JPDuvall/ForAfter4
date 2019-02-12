<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    public $timestamps = false;

    public $primaryKey = 'id';

    public function activity()
    {
        return $this->hasOne('App\Activity', 'id', 'activity_id');
    }
}
