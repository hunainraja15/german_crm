<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function offerCreation()
    {
        return $this->hasOne(OfferCreation::class, 'interview_id');
    }
    
}
