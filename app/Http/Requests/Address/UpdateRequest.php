<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=>["required","string","max:255", Rule::unique('address')->whereNull('deleted_at')],
            "city"=>["required","string","max:255"],
            "address"=>["required","string"],
            "receiver_full_name"=>["required","string","max:255"],
        ];
    }
}
