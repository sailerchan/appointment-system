<?php
// app/Http/Requests/UpdateUserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'sometimes|email|unique:users,email,' . $this->route('user')->user_id . ',user_id',
            'password_hash' => 'sometimes|string|min:6',
            'full_name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'role_id' => 'sometimes|exists:roles,role_id',
            'position_id' => 'nullable|exists:positions,position_id',
            'status_id' => 'sometimes|exists:status,status_id'
        ];
    }
}
