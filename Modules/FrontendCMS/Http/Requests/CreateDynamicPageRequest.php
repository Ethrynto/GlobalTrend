<?php

namespace Modules\FrontendCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateDynamicPageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $r)
    {
        $code = auth()->user()->lang_code;
        return [
            'title.'. $code => 'required',
            'slug.'. $code => 'required|unique:dynamic_pages,slug',
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

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
