<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Campaign extends Model{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'banner',
        'start_date',
        'end_date',
        'is_active',
    ];
   public function donations()
    {
        return $this->hasMany(donationList::class, 'campaign_id');
    }

    
}
