<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMenuRequest extends FormRequest
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
            'name.'. $code => 'required|max:255',
            'slug' => "required|unique:menus,slug,".$this->id,
            'menu_type' => 'required',
            'menu_position' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.*.required' => 'The name field is required',
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
