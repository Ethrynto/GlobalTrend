<?php

namespace Modules\FrontendCMS\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscribeContentRequest extends FormRequest
{
    public function rules()
    {
        $code = auth()->user()->lang_code;
        return [
            'title.'. $code => 'nullable|max:255',
            'subtitle.'. $code => 'nullable|max:255',
            'second' => 'nullable',
            'description.'. $code => 'nullable',
            'popup_image' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'title.*.max' => 'The title max length must be 255 words',
            'subtitle.*.max' => 'The subtitle max length must be 255 words',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
