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
            'administrator_id' => 'required|exists:users,user_id',
            'timestop_id' => 'required|exists:time_slots,timestop_id',
            'status_id' => 'required|exists:status,status_id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:120',
            'purpose_notes' => 'required|string|max:1000',
            'reference_no' => 'required|string|unique:appointments,reference_no'
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
