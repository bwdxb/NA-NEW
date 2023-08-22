<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MallRequest extends FormRequest
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
            'username' => 'required',
            'email'=> 'required',
            'store_name'=> 'required',
            'store_url'=> 'sometimes|required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'company_name'=> 'required',
            'gender'=> 'required',
            'company_type'=> 'required',
            'business_name'=> 'required',
            'trade_reg_no'=> 'required',
        ];
    }

    public function messages(){
        return [
           
            'store_name.required'=> 'Store name field required.',
            'store_url.regex'=> 'Store url must be valid url .',
            'company_name.required'=> 'company name field required.',
            'company_type.required'=> 'company name field required.',
            'business_name.required'=> 'business name field required.',
            'trade_reg_no.required'=> 'trade register number field required.',
        ];
    }
}
