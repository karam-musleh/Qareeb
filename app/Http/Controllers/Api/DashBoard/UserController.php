<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Models\Location;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->authorize('viewAny', User::class);
    }

    /**
     * عرض جميع المستخدمين مع الفلترة والبحث
     *
     * GET /api/admin/users
     * GET /api/admin/users?search=محمد
     * GET /api/admin/users?role=admin
     * GET /api/admin/users?location_id=2
     * GET /api/admin/users?status=active
     * GET /api/admin/users?sort_by=name&sort_order=asc
     * GET /api/admin/users?per_page=25
     */
    public function index(Request $request)
    {
        $query = User::with('location')->latest();

        // ============================================
        // البحث
        // ============================================
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // ============================================
        // الفلترة حسب الدور
        // ============================================
        if ($request->filled('role')) {
            $role = $request->role;
            if ($role === 'admin') {
                $query->where('is_admin', true);
            } elseif ($role === 'user') {
                $query->where('is_admin', false);
            }
        }

        // ============================================
        // الفلترة حسب المنطقة
        // ============================================
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // ============================================
        // الفلترة حسب حالة الحساب
        // ============================================
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($status === 'inactive') {
                $query->whereNotNull('deleted_at');
            }
        }

        // ============================================
        // الفلترة حسب التاريخ
        // ============================================
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                $request->from_date . ' 00:00:00',
                $request->to_date . ' 23:59:59'
            ]);
        }

        // ============================================
        // الترتيب
        // ============================================
        $sortBy = $request->filled('sort_by') ? $request->sort_by : 'created_at';
        $sortOrder = $request->filled('sort_order') ? $request->sort_order : 'desc';

        // التحقق من أن حقل الترتيب موجود
        $allowedSortFields = ['id', 'name', 'email', 'phone', 'is_admin', 'created_at', 'updated_at'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // ============================================
        // العد الإجمالي
        // ============================================
        $totalCount = $query->count();

        // ============================================
        // Pagination
        // ============================================
        $perPage = $request->query('per_page', 10);
        $users = $query->paginate($perPage);

        return $this->successResponse(
            [
                'data' => UserResource::collection($users),
                'pagination' => [
                    'total' => $users->total(),
                    'per_page' => $users->perPage(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                ],
                'filters' => [
                    'total_count' => $totalCount,
                    'admin_count' => User::where('is_admin', true)->count(),
                    'user_count' => User::where('is_admin', false)->count(),
                ],
            ],
            'Users fetched successfully'
        );
    }

    /**
     * عرض إحصائيات المستخدمين
     *
     * GET /api/admin/users/stats/overview
     */
    public function stats()
    {
        $stats = [
            'total_users' => User::count(),
            'admin_count' => User::where('is_admin', true)->count(),
            'regular_user_count' => User::where('is_admin', false)->count(),
            'users_this_month' => User::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'users_this_week' => User::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'locations_distribution' => Location::withCount('users')
                ->where('type', 'area')
                ->orderByDesc('users_count')
                ->limit(10)
                ->get()
                ->map(function ($location) {
                    return [
                        'location_id' => $location->id,
                        'location_name' => $location->name,
                        'user_count' => $location->users_count,
                    ];
                }),
        ];

        return $this->successResponse($stats, 'User statistics fetched successfully');
    }

    /**
     * عرض مستخدم واحد
     *
     * GET /api/admin/users/{id}
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return $this->successResponse(
            new UserResource($user->load('location')),
            'User fetched successfully'
        );
    }

    /**
     * تحديث المستخدم (الاسم، الإيميل، الموقع، إلخ)
     *
     * PUT /api/admin/users/{id}
     *
     * {
     *     "name": "أحمد محمد",
     *     "email": "ahmed@example.com",
     *     "phone": "0599123456",
     *     "location_id": 2
     * }
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        return $this->successResponse(
            new UserResource($user->load('location')),
            'User updated successfully'
        );
    }

    /**
     * تغيير الدور (admin/user)
     *
     * PUT /api/admin/users/{id}/role
     *
     * {
     *     "role": "admin"  (or "user")
     * }
     */
    public function changeRole(Request $request, User $user)
    {
        $this->authorize('changeRole', $user);

        if ($user->id === auth()->id()) {
            return $this->errorResponse(
                'لا يمكنك تغيير دورك بنفسك',
                403
            );
        }

        $request->validate([
            'role' => ['required', 'in:admin,user'],
        ], [
            'role.required' => 'حقل الدور مطلوب',
            'role.in' => 'يجب اختيار دور صحيح (admin أو user)',
        ]);

        $oldRole = $user->is_admin ? 'admin' : 'user';
        $newRole = $request->role;

        $user->update([
            'is_admin' => $request->role === 'admin'
        ]);

        // تسجيل في الـ logs (اختياري)
        \Log::info("User role changed", [
            'admin_id' => auth()->id(),
            'user_id' => $user->id,
            'old_role' => $oldRole,
            'new_role' => $newRole,
        ]);

        return $this->successResponse(
            new UserResource($user),
            "User role changed from {$oldRole} to {$newRole}"
        );
    }

    /**
     * حذف مستخدم واحد
     *
     * DELETE /api/admin/users/{id}
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if ($user->id === auth()->id()) {
            return $this->errorResponse(
                'لا يمكنك حذف حسابك بنفسك',
                403
            );
        }

        // حفظ البيانات قبل الحذف
        $userName = $user->name;
        $userId = $user->id;

        $user->delete();

        // تسجيل في الـ logs
        \Log::info("User deleted", [
            'admin_id' => auth()->id(),
            'deleted_user_id' => $userId,
            'deleted_user_name' => $userName,
        ]);

        return $this->successResponse(
            null,
            "User '{$userName}' deleted successfully"
        );
    }

    /**
     * حذف عدة مستخدمين دفعة واحدة
     *
     * POST /api/admin/users/bulk/delete
     *
     * {
     *     "ids": [3, 5, 7, 9]
     * }
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:users,id'],
        ], [
            'ids.required' => 'يجب اختيار مستخدمين للحذف',
            'ids.array' => 'يجب أن تكون IDs مصفوفة',
            'ids.min' => 'يجب اختيار مستخدم واحد على الأقل',
        ]);

        // منع حذف المستخدم الحالي
        if (in_array(auth()->id(), $request->ids)) {
            return $this->errorResponse(
                'لا يمكنك حذف حسابك بنفسك',
                403
            );
        }

        $usersToDelete = User::whereIn('id', $request->ids)->get();
        $deletedCount = $usersToDelete->count();
        $deletedNames = $usersToDelete->pluck('name')->toArray();

        User::whereIn('id', $request->ids)->delete();

        // تسجيل في الـ logs
        \Log::info("Bulk users deletion", [
            'admin_id' => auth()->id(),
            'deleted_count' => $deletedCount,
            'deleted_ids' => $request->ids,
            'deleted_names' => $deletedNames,
        ]);

        return $this->successResponse(
            [
                'deleted_count' => $deletedCount,
                'deleted_users' => $deletedNames,
            ],
            "Successfully deleted {$deletedCount} user(s)"
        );
    }

    /**
     * الحصول على قائمة الفلاتر المتاحة
     *
     * GET /api/admin/users/filters/available
     */
    public function getAvailableFilters()
    {
        $locations = Location::where('type', 'area')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $filters = [
            'roles' => [
                ['id' => 'admin', 'label' => 'Admin'],
                ['id' => 'user', 'label' => 'User'],
            ],
            'statuses' => [
                ['id' => 'active', 'label' => 'Active'],
                ['id' => 'inactive', 'label' => 'Inactive'],
            ],
            'locations' => $locations,
            'sort_fields' => [
                ['value' => 'name', 'label' => 'Name'],
                ['value' => 'email', 'label' => 'Email'],
                ['value' => 'created_at', 'label' => 'Created Date'],
                ['value' => 'updated_at', 'label' => 'Updated Date'],
            ],
            'sort_orders' => [
                ['value' => 'asc', 'label' => 'Ascending'],
                ['value' => 'desc', 'label' => 'Descending'],
            ],
        ];

        return $this->successResponse($filters, 'Available filters fetched successfully');
    }
}
