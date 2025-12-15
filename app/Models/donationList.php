<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class donationList extends Model
{
    protected $table = 'donation_lists';

    protected $fillable = [
        'user_id',
        'full_name',
        'type',
        'amount',
        'payment_status',
        'pickup_type',   // new
        'pickup_date', 
        'campaign_id',  // new
        'status'         // new
    ];

    public function campaign()
{
    return $this->belongsTo(Campaign::class, 'campaign_id');
}

}
