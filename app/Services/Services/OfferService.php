<?php
namespace App\Services\Services;

use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Services\Constructors\OfferConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferService implements OfferConstructor
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return OfferResource::collection(
            Offer::all()
        );
    }

    /**
     * Display the specified resource.
     *
     * @return OfferResource
     */
    public function show($slug) : OfferResource
    {
        $offer  = Offer::where('slug', $slug)->first();
        return OfferResource::make($offer);
    }
}
