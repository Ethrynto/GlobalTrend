<?php

namespace Modules\FrontendCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDynamicPageRequest extends FormRequest
{
    
    public function rules()
    {
        $code = auth()->user()->lang_code;
        return [
            'title.'. $code => 'required',
            'slug.'. $code => 'required|unique:dynamic_pages,slug,'.$this->id,
            'description.'. $code => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.*.required' => 'The dynamic pages title is required',
            'slug.*.required' => 'The dynamic pages slug is required',
            'slug.*.unique_translation' => 'The dynamic pages slug has already been taken',
            'description.*.required' => 'The dynamic pages description is required',
        ];
    }

    
    public function authorize()
    {
        return true;
    }
}
