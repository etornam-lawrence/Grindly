<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SessionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
    {
        Log::info('Payload before validation', request()->all());

        // Validate the request data before reaching controller and model
        return [
            'title' => 'required|string|max:255',
            'start_time' => 'required|date', // Or use 'date_format:Y-m-d H:i:s' if strict format needed
            'end_time' => 'required|date|after_or_equal:start_time',
            'study_duration' => 'required|integer|min:1',
        ];
    }


}
