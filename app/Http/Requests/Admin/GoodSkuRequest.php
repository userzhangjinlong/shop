<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GoodSkuRequest extends FormRequest
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
            'goods_id'  =>  'required',
            'price'     =>  'required|numeric|min:0',
            'stock'     =>  'required|min:0|integer'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'goods_id'  =>  '商品',
            'price'     =>  '价格',
            'stock'     =>  '库存'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'price.min'     =>  '价格必须大于0',
        ];
    }
}
