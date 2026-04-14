<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;



class RegisterController extends Controller
{

    use ApiResponseTrait;


    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'location_id' => $request->location_id,
            'specialization' => $request->specialization,
        ]);
        $token = Auth::guard('api')->login($user);
        $user->load('location');

        return $this->successResponse(['user' => new UserResource($user), 'token' => $token], __('messages.user_registered_successfully'), 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->errorResponse(__('messages.user_not_found'), 401);
        }
        if (!Hash::check($request->password, $user->password)) {
            return $this->errorResponse(__('messages.invalid_password'), 400);
        }

        $token = Auth::guard('api')->login($user);
        $user->load('location');
        return $this->successResponse(
            [
                'user' =>  new UserResource($user),
                'token' => $token
            ],
            __('messages.user_logged_in'),
            200,

        );
    }


    public function logout()
    {
        try {
            auth()->guard('api')->logout();
            return $this->successResponse(null, __('messages.user_logged_out'), 200);
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }


    public function refresh()
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();
            return response()->json([
                'status' => 'success',
                'token' => $newToken
            ], 200);
        } catch (JWTException $e) {
            return $this->errorResponse(__('messages.token_refresh_failed'), 401);
        }
    }
    public function profile()
    {
        $user = auth()->guard('api')->user();
        $user->load('location');
        return $this->successResponse(new UserResource($user), __('messages.user_profile_retrieved'), 200);
    }
    //
    // update profile
    public function updateProfile(UserRequest $request)
    {
        $user = auth()->guard('api')->user();
        $validatedData = $request->validated();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);
        $user->load('location');
        return $this->successResponse(new UserResource($user), __('messages.profile_updated'), 200);
    }
}
