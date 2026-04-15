<?php

namespace App\Http\Controllers\Api\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    use ApiResponseTrait;


    public function index(Request $request)
    {

        $request->validate([
            'type' => 'nullable|in:governorate,city,area',
            'parent_id' => 'nullable|exists:locations,id'
        ]);

        $query = Location::query();

        // تحديد النوع
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // تحديد الأب
        if ($request->filled('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        }


        $locations = $query->with('parent', 'children')->orderBy('id')->get();

        return $this->successResponse(
            LocationResource::collection($locations),
            __('messages.locations_retrieved')
        );
    }


    //store
    public function store(LocationRequest $request)
    {

        $location = Location::create($request->validated());
        $location->load('parent');
        // dd($location);
        return $this->successResponse(new LocationResource($location), __('messages.location_created'), 201);
    }

    //show
    public function show($slug)
    {
        $location = Location::with('parent', 'children')->where('slug', $slug)->first();
        if (!$location) {
            return $this->errorResponse(__('messages.location_not_found'), 404);
        }
        return $this->successResponse(new LocationResource($location), __('messages.location_retrieved'));
    }

    public function update(LocationRequest $request, $slug)
    {
        $location = Location::where('slug', $slug)->first();
        if (!$location) {
            return $this->errorResponse(__('messages.location_not_found'), 404);
        }
        $location->update($request->validated());
        $location->load('parent , children');
        return $this->successResponse(new LocationResource($location), __('messages.location_updated'));
    }
    public function destroy($slug)
    {
        $location = Location::where('slug', $slug)->first();
        if (!$location) {
            return $this->errorResponse(__('messages.location_not_found'), 404);
        }
        $location->delete();
        return $this->successResponse(null, __('messages.location_deleted'));
    }
}
