<?php

namespace App\Rules;

use App\Services\CitizenService;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class ValidCitizen implements Rule, DataAwareRule
{
    protected $citizenService;
    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->citizenService = new CitizenService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->citizenService->verifyNid($this->data['nid'], $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute doesn\'t match with the nid.';
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
