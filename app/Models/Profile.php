<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    public function profileFiles()
    {
        return $this->hasMany(ProfileFile::class, 'profile_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

    protected $guarded = [];
}
