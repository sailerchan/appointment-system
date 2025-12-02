<?php
// app/Http/Requests/StoreResidentRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResidentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,user_id',
            'full_name' => 'required|string|max:255',
            'email_address' => 'required|email|unique:residents,email_address',
            'phone_number' => 'required|string|max:20'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'Selected user does not exist.',
            'email_address.unique' => 'This email address is already registered as a resident.'
        ];
    }
}
