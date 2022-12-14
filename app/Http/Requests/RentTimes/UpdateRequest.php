<?php

namespace App\Http\Requests\RentTimes;

use App\Http\Requests\ApiFormRequest;

class UpdateRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasAnyRole("renter","admin");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=>["string","max:255","required"],
            "amount_of_time"=>["numeric","required"],
            "type_of_period"=>["string","required","max:255"],
            "product_id" => ["required"],
            "cost"=>["required","numeric"]
        ];
    }
}
