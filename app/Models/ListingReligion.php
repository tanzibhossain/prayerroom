<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingReligion extends Model
{
    protected $fillable = [
        'listing_id',
        'religion_id',
    ];
}
