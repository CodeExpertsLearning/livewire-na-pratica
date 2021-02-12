<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type', 'rule'];

    public function getRuleAttribute()
    {
        return json_decode($this->attributes['rule'], 2);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
