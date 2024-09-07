<?php

namespace Modules\Appearance\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SliderSetupRequest extends FormRequest
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
            'name.'. $code => 'required',
            'slider_image_media' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.*.required' => 'The slider name field is required',
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
