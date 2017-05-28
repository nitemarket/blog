<?php

namespace App;

use Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Blog extends Moloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'published_at'];

    protected $primaryKey = '_id';

    protected $connection = 'mongodb';

    protected $fillable = [
        'title', 'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
