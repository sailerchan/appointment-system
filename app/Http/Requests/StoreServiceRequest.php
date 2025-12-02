<?php
// app/Http/Requests/StoreServiceRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_name' => 'required|string|max:255|unique:services',
            'category_id' => 'required|exists:categories,category_id'
        ];
    }

    public function messages(): array
    {
        return [
            'service_name.unique' => 'This service name already exists.',
            'category_id.exists' => 'Selected category does not exist.'
        ];
    }
}
