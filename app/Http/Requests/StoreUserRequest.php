<?php
// app/Http/Requests/StoreUserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password_hash' => 'required|string|min:6',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'role_id' => 'required|exists:roles,role_id',
            'position_id' => 'nullable|exists:positions,position_id',
            'status_id' => 'required|exists:status,status_id'
        ];
    }

    public function messages(): array
    {
        return [
            'password_hash.min' => 'Password must be at least 6 characters.',
            'phone_number.max' => 'Phone number cannot exceed 20 characters.'
        ];
    }
}
