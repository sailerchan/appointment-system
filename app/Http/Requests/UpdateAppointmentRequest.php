<?php
// app/Http/Requests/UpdateAppointmentRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resident_id' => 'sometimes|exists:residents,resident_id',
            'service_id' => 'sometimes|exists:services,service_id',
            'role_id' => 'sometimes|exists:users,user_id',
            'timestop_id' => 'sometimes|exists:time_slots,timestop_id',
            'status_id' => 'sometimes|exists:status,status_id',
            'appointment_date' => 'sometimes|date|after_or_equal:today',
            'appointment_time' => 'sometimes|date_format:H:i',
            'duration_minutes' => 'sometimes|integer|min:15|max:120',
            'purpose_notes' => 'sometimes|string|max:1000',
            'reference_no' => 'sometimes|string|unique:appointments,reference_no,' . $this->route('appointment')->appointment_id . ',appointment_id'
        ];
    }
}

