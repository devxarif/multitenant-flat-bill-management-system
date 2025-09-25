<?php

namespace App\Models;

use App\Scopes\ScopesByOwner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id','owner_id','flat_number','flat_owner_name','flat_owner_phone'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ScopesByOwner);

        static::creating(function ($m) {
            if (auth()->check() && auth()->user()->role === 'owner') {
                $m->owner_id = auth()->id();
            }
        });
    }

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function tenants() {
        return $this->belongsToMany(Tenant::class, 'flat_tenant')->withTimestamps();
    }
}
