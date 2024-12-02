<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Services\Facades\OfferFacade;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return OfferFacade::index();
    }

    /**
     * Display the specified resource.
     *
     * @return OfferResource
     */
    public function show(string $slug) : OfferResource
    {
        return OfferFacade::show($slug);
    }
}
