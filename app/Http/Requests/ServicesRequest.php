<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
            "id"=>"bail|required_if:action,update,enable,disable|nullable|exists:services,id",
            "action"=>"bail|required|in:insert,update,enable,disable",
            "heading_top"=>"bail|nullable|string|max:500",
            "heading_middle"=>"bail|nullable|string",
            "heading_bottom"=>"bail|nullable|string|max:500",
            "image"=>"bail|file|image|required_if:action,insert",
            "slide_status"=>"required_if:action,update|in:live,disabled",
            "slide_sorting"=>"required_if:action,update,insert|numeric|gt:0"
        ];
    }
}
