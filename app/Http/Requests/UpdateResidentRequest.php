<?php
// app/Http/Requests/UpdateResidentRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,user_id',
            'full_name' => 'sometimes|string|max:255',
            'email_address' => 'sometimes|email|unique:residents,email_address,' . $this->route('resident')->resident_id . ',resident_id',
            'phone_number' => 'sometimes|string|max:20'
        ];
    }
}
