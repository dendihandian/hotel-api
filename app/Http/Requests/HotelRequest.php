<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'hotel_name' => ['required', 'max:64'],
            'address' => ['nullable'],
        ];

        if ($this->isMethod('PUT')) {
            // rules modification for update here
        }

        return $rules;
    }
}