<?php

namespace App\Http\Controllers\Api\DashBoard;

use App\Models\Hub;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OfferController extends Controller
{
    use ApiResponseTrait, AuthorizesRequests;
    public function index(Hub $hub)
    {
        $perPage = request()->query('per_page', 10);

        $offers = $hub->offers()->latest()->paginate($perPage);

        return $this->successResponse(
            OfferResource::collection($offers),
            __('messages.offers_fetched')

        );
    }
    public function store(Hub $hub, OfferRequest $request)
    {
        $this->authorize('create', [Offer::class, $hub]);

        $data = $request->validated();

        // تأكد إن الحقول nullable موجودة حتى لو مش مرسلة
        $data['starts_at'] = $data['starts_at'] ?? null;
        $data['ends_at'] = $data['ends_at'] ?? null;

        $offer = $hub->offers()->create($data);

        return $this->successResponse(
            new OfferResource($offer),
            __('messages.offer_created'),
            201
        );
    }
    public function show(Hub $hub, Offer $offer)
    {

        return $this->successResponse(
            new OfferResource($offer),
            __('messages.offer_fetched')
        );
    }
    public function update(Hub $hub, Offer $offer, OfferRequest $request)
    {
        $this->authorize('update', $offer);

        $data = $request->validated();

        // تأكد إن الحقول nullable موجودة حتى لو مش مرسلة
        $data['starts_at'] = $data['starts_at'] ?? null;
        $data['ends_at'] = $data['ends_at'] ?? null;

        $offer->update($data);

        return $this->successResponse(
            new OfferResource($offer),
            __('messages.offer_updated')
        );
    }


    public function destroy(Hub $hub, Offer $offer)
    {
        $this->authorize('delete', $offer);

        $offer->delete();

        return $this->successResponse(
            null,
            __('messages.offer_deleted')
        );
    }
}
