<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// This class is used to validate profile update data
class ProfileUpdateRequest extends FormRequest
{
    /**
     * Set the validation rules for the form fields.
     */
    public function rules(): array
    {
        $rules = [];

        // If there is an avatar uploaded
        if ($this->hasFile('avatar')) {
            // Check that it's an image, allowed types, and not too large (max 10MB)
            $rules['avatar'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'];
        }

        // If there is a first name, check it's a string and not too long
        if ($this->has('first_name')) {
            $rules['first_name'] = ['string', 'max:255'];
        }

        // If there is a last name, check it's a string and not too long
        if ($this->has('last_name')) {
            $rules['last_name'] = ['string', 'max:255'];
        }

        // If there is a phone number, check it's a string and not too long
        if ($this->has('phone')) {
            $rules['phone'] = ['nullable', 'string', 'max:20'];
        }

        // If there is an email
        if ($this->has('email')) {
            // Email is required, must be valid, lowercase, and unique (except for current user)
            $rules['email'] = [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ];
        }

        // If there is a password
        if ($this->has('password')) {
            // Password is optional, must be at least 6 characters and match confirmation
            $rules['password'] = ['nullable', 'string', 'min:6', 'confirmed'];
        }

        return $rules;
    }

    // Allow the request (no special permission needed)
    public function authorize(): bool
    {
        return true;
    }

}
