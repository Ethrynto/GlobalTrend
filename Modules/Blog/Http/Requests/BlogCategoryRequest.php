<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $code = auth()->user()->lang_code;
        return [
            'name.'. $code => "required",
            'blog_image' => 'required'
        ];
    }
    public function messages()
    {
        return [
        'name.*.required' => 'The category name is required',
                'name.*.unique_translation' => 'The category name has already been taken',
                'blog_image.required' => 'The Image field is required'
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
