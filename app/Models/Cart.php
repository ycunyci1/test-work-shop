<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    protected $guarded = ['id'];
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }
}
