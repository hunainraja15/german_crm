<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileFile extends Model
{
    use HasFactory;
    public function profile(){
        return $this->belongsTo(Profile::class , 'profile_files');
    }
    protected $guarded = [];
}
