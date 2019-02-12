<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityMedia extends Model
{
    public function activity() {
        return $this->belongsTo('App\Activity');
    }
}
