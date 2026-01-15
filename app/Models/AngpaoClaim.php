<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AngpaoClaim extends Model
{
    protected $fillable = ['angpao_pool_id', 'claimed_by', 'amount'];

    public function pool(): BelongsTo
    {
        return $this->belongsTo(AngpaoPool::class, 'angpao_pool_id');
    }
}