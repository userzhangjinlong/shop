<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CateSearchValRequest extends FormRequest
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
            'searchproperty_value'  =>  'required',
            'search_val'            =>  'required'
        ];
    }

    public function attributes()
    {
        return [
            'searchproperty_value'  =>  '属性值',
            'search_val'            =>  '搜索值'
        ];
    }

}
