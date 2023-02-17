<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Variation;

class VariationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            Variation::ATTR_REFERENCE => 'required|unique:'.Variation::TABLE_NAME.','.Variation::ATTR_PK.','.$this->variation,
            Variation::ATTR_DESCRIPTION => 'required',
            Variation::ATTR_PRICE => 'required|numeric',
            Variation::ATTR_PRODUCT_ID => 'required|exists:products,id'
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ], 422));
    }
}
