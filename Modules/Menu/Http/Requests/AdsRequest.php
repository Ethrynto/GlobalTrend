<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdsRequest extends FormRequest
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
            'subtitle.'. $code => 'required',
            'menu_ads_image' => 'nullable',
            'link' => 'required',
            'menu_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'title.*.required' => 'The title field is required.',
            'subtitle.*.required' => 'The subtitle field is required.'
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
