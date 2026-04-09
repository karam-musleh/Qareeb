<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceController extends Controller
{
    use ApiResponseTrait, AuthorizesRequests;

    public function index()
    {
        // $lang = request()->query('lang', app()->getLocale());
        $per_page = request()->query('per_page', 15);

        $services = Service::active()
            ->global()
            ->latest()
            ->paginate($per_page);

        return $this->successResponse(
            ServiceResource::collection($services),
            'Services fetched successfully'
        );
    }

    public function store(ServiceRequest $request)
    {
        // dd($request->validated());

        $data = Service::create($request->validated());
        $data['hub_id'] = null;
        $data['is_global'] = true;
        $data->save();


        return $this->successResponse(
            new ServiceResource($data),
            'Service created successfully',
            201
        );
    }


    public function show($id)
    {
        // $lang = request()->query('lang', app()->getLocale());

        $service = Service::findOrFail($id);

        if (!$service->is_active) {
            return $this->errorResponse('Service not found', 404);
        }

        return $this->successResponse(
            new ServiceResource($service),
            'Service fetched successfully'
        );
    }

    public function update(ServiceRequest $request, $id)
    {

        $service = Service::where('id', $id)
            ->where('is_global', true)
            ->firstOrFail();
        $service->update($request->validated());
        unset($data['hub_id']);
        unset($data['is_global']);
        return $this->successResponse(
            new ServiceResource($service),
            'Service updated successfully'
        );
    }

    // Admin فقط - حذف الخدمة
    public function destroy($id)
    {

        $service = Service::where('id', $id)
            ->where('is_global', true)
            ->firstOrFail();
        $service->delete();

        return $this->successResponse(
            null,
            'Service deleted successfully'
        );
    }
}
