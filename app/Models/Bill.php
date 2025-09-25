<?php

namespace App\Models;

use App\Scopes\ScopesByOwner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'building_id',
        'flat_id',
        'bill_category_id',
        'month',
        'amount',
        'carried_due',
        'total_due',
        'status',
        'notes'
    ];

    protected $casts = [
        'month' => 'date'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ScopesByOwner);
    }

    public function flat() {
        return $this->belongsTo(Flat::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category() {
        return $this->belongsTo(BillCategory::class, 'bill_category_id');
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
