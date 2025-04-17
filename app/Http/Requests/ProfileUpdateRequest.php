<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [];

        // Validation pour 'avatar'
        if ($this->hasFile('avatar')) {
            $rules['avatar'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'];
        }

        // Validation pour 'first_name'
        if ($this->has('first_name')) {
            $rules['first_name'] = ['string', 'max:255'];
        }

        // Validation pour 'last_name'
        if ($this->has('last_name')) {
            $rules['last_name'] = ['string', 'max:255'];
        }

        // Validation pour 'phone'
        if ($this->has('phone')) {
            $rules['phone'] = ['nullable', 'string', 'max:20'];
        }

        // Validation pour 'email'
        if ($this->has('email')) {
            $rules['email'] = [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ];
        }

        if ($this->has('password')) {
            $rules['password'] = ['nullable', 'string', 'min:6', 'confirmed'];
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }

}
