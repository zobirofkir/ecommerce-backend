<?php

namespace App\Observers;

use App\Models\Offer;
use Illuminate\Support\Str;

class OfferObserver
{
    public function creating(Offer $offer)
    {
        $offer->slug = Str::slug($offer->title);
    }

    public function updating(Offer $offer)
    {
        if ($offer->isDirty('title')) {
            $offer->slug = Str::slug($offer->title);
        }
    }
}
