<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['id','name'];
    private $created_at;

    public function districts()
    {
        $this->hasMany('App\Models\District', 'city_id', 'id');
    }

    public function address()
    {
        $this->belongsTo('App\Models\Address', 'city_id', 'id');
    }

    public function getTimeAgoAttributes()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
