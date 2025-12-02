<?php
// app/Http/Requests/StoreTimeSlotRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slot_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_capacity' => 'required|integer|min:1|max:50',
            'available_slots' => 'required|integer|min:0|lte:max_capacity'
        ];
    }

    public function messages(): array
    {
        return [
            'slot_date.after_or_equal' => 'Slot date cannot be in the past.',
            'end_time.after' => 'End time must be after start time.',
            'max_capacity.min' => 'Maximum capacity must be at least 1.',
            'max_capacity.max' => 'Maximum capacity cannot exceed 50.',
            'available_slots.min' => 'Available slots cannot be negative.',
            'available_slots.lte' => 'Available slots cannot exceed maximum capacity.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->slot_date && $this->start_time && $this->end_time) {
                $startDateTime = $this->slot_date . ' ' . $this->start_time;
                $endDateTime = $this->slot_date . ' ' . $this->end_time;

                if (strtotime($endDateTime) <= strtotime($startDateTime)) {
                    $validator->errors()->add('end_time', 'End time must be after start time on the same day.');
                }
            }
        });
    }
}
