<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AngpaoPool extends Model
{
    protected $fillable = ['name', 'total_amount', 'total_slots', 'remaining_slots', 'status'];

    public function claims(): HasMany
    {
        return $this->hasMany(AngpaoClaim::class);
    }
}