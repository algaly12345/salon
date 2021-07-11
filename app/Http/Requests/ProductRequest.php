<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'productName' => 'required',
            'productDescription' => 'required',
            'productShortDescription' => 'required',
            'productNewPrice' => 'required|numeric',
            'quantity' => 'required|numeric',
            'stock' => 'required|numeric',
//            'subCategoryId'  => 'required|exists:SubCategories,subCategoryId',

        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'productDescription.string' => 'العنوان لابد ان يكون حروف او حروف وارقام ',
            'productName.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',



        ];
    }
}
