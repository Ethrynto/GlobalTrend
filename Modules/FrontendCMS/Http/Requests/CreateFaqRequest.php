<?php

namespace Modules\FrontendCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFaqRequest extends FormRequest
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
            'title.'. $code =>'required',
            'description.'. $code =>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.*.required' => 'The title field is required',
            'description.*.required' => 'The description field is required',
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
