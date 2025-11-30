<?php
// app/Http/Controllers/RoleController.php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(): JsonResponse
    {
        $roles = Role::all();

        return response()->json([
            'success' => true,
            'data' => $roles
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'role_name' => 'required|string|unique:roles',
            'description' => 'nullable|string'
        ]);

        $role = Role::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully',
            'data' => $role
        ], 201);
    }

    public function show(Role $role): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $role
        ]);
    }

    public function update(Request $request, Role $role): JsonResponse
    {
        $validated = $request->validate([
            'role_name' => 'sometimes|string|unique:roles,role_name,' . $role->role_id . ',role_id',
            'description' => 'nullable|string'
        ]);

        $role->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully',
            'data' => $role
        ]);
    }

    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully'
        ]);
    }

    // Custom method to get users by role
    public function getUsersByRole(Role $role): JsonResponse
    {
        $users = $role->users()->with(['position', 'status'])->get();

        return response()->json([
            'success' => true,
            'data' => [
                'role' => $role,
                'users' => $users
            ]
        ]);
    }

    // Custom method to get role permissions (if you add permissions later)
    public function getRolePermissions(Role $role): JsonResponse
    {
        // This can be extended when you implement permissions
        $permissions = [
            'can_view_appointments' => true,
            'can_manage_users' => $role->role_name === 'admin staff',
            'can_manage_settings' => $role->role_name === 'admin staff',
            'can_create_appointments' => true
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'role' => $role,
                'permissions' => $permissions
            ]
        ]);
    }
}
