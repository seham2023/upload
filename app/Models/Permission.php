<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }


    protected $casts = [
        'capabilities' => 'array',
    ];
}
