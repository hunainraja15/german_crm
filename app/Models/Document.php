<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function personalDetail()
    {
        return $this->belongsTo(PersonalDetail::class);
    }
    
    // Similarly, define other relationships if needed
}

