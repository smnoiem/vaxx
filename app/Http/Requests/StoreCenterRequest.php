<?php

namespace App\Http\Requests;

use App\Models\Center;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCenterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique(Center::class)->ignore($this->id)],
            'address' => 'required|string|max:350',
            'daily_limit' => 'required|numeric',
        ];
    }
}
