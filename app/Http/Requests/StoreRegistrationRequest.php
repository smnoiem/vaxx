<?php

namespace App\Http\Requests;

use App\Rules\ValidCitizen;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
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
        return [
            'nid' => 'required|string|max:17|min:10|exists:App\Models\Citizen|unique:App\Models\Registration',
            'dob' => ['required', 'date', new ValidCitizen],
            'phone' => 'required|string|min:11',
            'center_id' => 'required|exists:App\Models\Center,id',
        ];
    }
}
