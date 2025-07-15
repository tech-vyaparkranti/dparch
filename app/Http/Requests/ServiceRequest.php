<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Service;

class ServiceRequest extends FormRequest
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
            Service::ID=>"bail|required_if:action,update,enable,disable|nullable|exists:service_projects,id",
            Service::SERVICE_NAME=>"bail|required_if:action,update,insert|nullable|string|max:500",
            Service::SERVICE_IMAGE=>"bail|required_if:action,insert|nullable|image|max:2048",
            Service::POSITION=>"required_if:action,update,insert|numeric|gt:0",
            "action"=>"bail|required|in:insert,update,enable,disable"
        ];
    }
}
