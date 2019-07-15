<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CateSearchRequest extends FormRequest
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
            'cate_id'       =>  'required',
            'property_name' =>  'required|max:20',
            'cate_name'     =>  'required'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'cate_id'       =>  '分类',
            'property_name' =>  '筛选属性名称',
            'cate_name'     =>  '分类'
        ];
    }
}
