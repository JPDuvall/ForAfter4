<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function media()
    {
        return $this->hasMany('App\ActivityMedia', 'activity_id');
    }

    public function terms()
    {
        return $this->hasOne('App\Term', 'activity_id');
    }
}
