<?php
// app/Http/Requests/StoreAppointmentRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resident_id' => 'required|exists:residents,resident_id',
            'service_id' => 'required|exists:services,service_id',
            'timeslot_id' => 'required|exists:time_slots,timeslot_id',
            'status_id' => 'nullable||exists:status,status_id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'purpose_notes' => 'sometimes|nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'appointment_date.after_or_equal' => 'Appointment date cannot be in the past.',
            'duration_minutes.min' => 'Duration must be at least 15 minutes.',
            'duration_minutes.max' => 'Duration cannot exceed 120 minutes.',
            'reference_no.unique' => 'This reference number already exists.'
        ];
    }
}

