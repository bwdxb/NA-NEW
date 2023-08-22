<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
    public function rules() {
        return [
            'offer_name'=>'required',
            'offer_code'=>'required',
            'offer_expiry_date'=>'required',
            'offer_type'=>'required',
            'discount_amount'=>'required|numeric',
            'discount_percentage'=>'required|numeric',
            'discount_for_user'=>'required',
            'discount_on'=>'required',
            'discount_on_product'=>'required',
        ];
    }

    public function messages(){
        return  [
            'offer_name.required'=>'offer name field required',
            'offer_code.required'=>'offer code field required',
            'offer_expiry_date.required'=>'offer expiry date field required',
            'offer_type.required'=>'offer type field required',
            'discount_amount.required'=>'offer discount amount field required',
            'discount_amount.numeric'=>'offer discount amount must be numeric  required',
            'discount_percentage.numeric'=>'offer discount percentage must be numeric  required',
            'discount_percentage.required'=>'offer discount percentage  field required',
            'discount_for_user.required'=>'offer discount to user field required',
            'discount_on.required'=>'discount on  field required',
            'discount_on_product.required'=>'discount on product  field required',

        ];
    }
}
