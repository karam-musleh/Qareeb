<?php

namespace App\Http\Controllers\Api\Hubs;

use App\Models\Hub;
use App\Models\Service;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    /**
     * جيب جميع الخدمات المتاحة (عامة + خاصة)
     * GET /api/hubs/{slug}/services
     */
    public function getCustomServices(Hub $hub)
    {
        $per_page = request()->query('per_page', 15);

        // الخدمات العامة اللي اختارها + خدماته الخاصة
        $services = Service::where(function ($query) use ($hub) {
            $query->where(function ($q) use ($hub) {
                // الخدمات العامة اللي في hub_service
                $q->where('services.is_global', true)
                    ->whereIn('services.id', $hub->services()->pluck('services.id'));
            })
                ->orWhere('services.hub_id', $hub->id);
        })
            ->where('services.is_active', true)
            ->latest()
            ->paginate($per_page);

        return $this->successResponse(
            ServiceResource::collection($services),
            'Hub services fetched successfully'
        );
    }

    /**
     * Hub Owner: ينشئ خدمة خاصة
     * POST /api/hubs/{slug}/custom-services
     */
    public function storeCustom(ServiceRequest $request, Hub $hub)
    {
        if ($hub->owner_id !== auth('api')->id()) {
            return $this->errorResponse('Unauthorized', 403);
        }

        $data = $request->validated();
        $data['is_global'] = false;
        $data['hub_id'] = $hub->id;

        $service = Service::create($data);

        return $this->successResponse(
            new ServiceResource($service),
            'Custom service created successfully',
            201
        );
    }

    /**
     * Hub Owner: يحدث خدمة خاصة
     * PUT /api/hubs/{slug}/custom-services/{serviceId}
     */
    public function updateCustom(ServiceRequest $request, Hub $hub, Service $service)
    {
        if ($hub->owner_id !== auth('api')->id()) {
            return $this->errorResponse('Unauthorized', 403);
        }

        if ($service->hub_id !== $hub->id || $service->is_global) {
            return $this->errorResponse('Service not found', 404);
        }

        $data = $request->validated();
        unset($data['hub_id']);
        unset($data['is_global']);

        $service->update($data);

        return $this->successResponse(
            new ServiceResource($service),
            'Custom service updated successfully'
        );
    }

    /**
     * Hub Owner: يحذف خدمة خاصة
     * DELETE /api/hubs/{slug}/custom-services/{serviceId}
     */
    public function destroyCustom(Hub $hub, Service $service)
    {
        if ($hub->owner_id !== auth('api')->id()) {
            return $this->errorResponse('Unauthorized', 403);
        }

        if ($service->hub_id !== $hub->id || $service->is_global) {
            return $this->errorResponse('Service not found', 404);
        }

        $service->delete();

        return $this->successResponse(
            null,
            'Custom service deleted successfully'
        );
    }
}
