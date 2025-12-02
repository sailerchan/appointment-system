<?php
// app/Http/Requests/UpdateServiceRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_name' => 'sometimes|string|max:255|unique:services,service_name,' . $this->route('service')->service_id . ',service_id',
            'category_id' => 'sometimes|exists:categories,category_id'
        ];
    }
}
