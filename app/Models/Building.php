<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'address'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function flats(){
        return $this->hasMany(Flat::class, 'building_id');
    }
}
