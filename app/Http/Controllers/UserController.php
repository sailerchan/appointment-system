<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::with(['role', 'position', 'status', 'resident'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password_hash' => 'required|string|min:6',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'role_id' => 'required|exists:roles,role_id',
            'position_id' => 'nullable|exists:positions,position_id',
            'status_id' => 'required|exists:status,status_id'
        ]);

        $validated['password_hash'] = Hash::make($validated['password_hash']);

        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user->load(['role', 'position', 'status'])
        ], 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $user->load(['role', 'position', 'status', 'resident'])
        ]);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'sometimes|email|unique:users,email,' . $user->user_id . ',user_id',
            'password_hash' => 'sometimes|string|min:6',
            'full_name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'role_id' => 'sometimes|exists:roles,role_id',
            'position_id' => 'nullable|exists:positions,position_id',
            'status_id' => 'sometimes|exists:status,status_id'
        ]);

        if (isset($validated['password_hash'])) {
            $validated['password_hash'] = Hash::make($validated['password_hash']);
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user->load(['role', 'position', 'status'])
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
