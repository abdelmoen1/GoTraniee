<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    protected $fillable = [
        'organization_name',
        'organization_type',
        'organization_description',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
