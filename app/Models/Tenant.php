<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'building_id',
        'name',
        'email',
        'phone',
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function flat() {
        return $this->belongsTo(Flat::class, 'flat_id');
    }

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function flats()
    {
        return $this->belongsToMany(Flat::class, 'flat_tenant')
                    ->withPivot(['move_in', 'move_out'])
                    ->withTimestamps();
    }
}
