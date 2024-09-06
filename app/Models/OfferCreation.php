<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCreation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }
}
