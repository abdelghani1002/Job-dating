<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnouncementRequest extends FormRequest
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
        return [
            'title'       => "bail|required|min:10|max:255",
            'start_date'  => "bail|required|date|after:tomorrow",
            'end_date'    => "bail|required|date|after:start_date",
            'description' => "bail|required|min:100",
        ];
    }
}
