<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class StudentProfile extends Model
{
    protected $fillable = [
    'user_id',
    'bio',
    'availability',
    'status',
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
