<?php
namespace App\Services\Constructors;

use App\Http\Resources\OfferResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface OfferConstructor
{
    public function index() : AnonymousResourceCollection;

    public function show(string $slug) : OfferResource;
}
