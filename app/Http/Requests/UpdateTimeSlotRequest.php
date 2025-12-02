<?php
// app/Http/Requests/UpdateTimeSlotRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimeSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slot_date' => 'sometimes|date|after_or_equal:today',
            'start_time' => 'sometimes|date_format:H:i',
            'end_time' => 'sometimes|date_format:H:i|after:start_time',
            'max_capacity' => 'sometimes|integer|min:1|max:50',
            'available_slots' => 'sometimes|integer|min:0|lte:max_capacity'
        ];
    }
}
