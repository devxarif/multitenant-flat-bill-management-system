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

    public function building() {
        return $this->belongsTo(Building::class);
    }
}
