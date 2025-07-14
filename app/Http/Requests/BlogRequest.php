<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Blog;
class BlogRequest extends FormRequest
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
        $action = $this->input('action');

        switch ($action) {
            case 'enable':
            case 'disable':
                return [
                    Blog::ID => 'required|exists:blogs,' . Blog::ID,
                ];

            case 'insert':
                return [
                    Blog::TITLE => 'required|string',
                    Blog::CONTENT => 'required|string',
                    Blog::BLOG_DATE => 'required|date',
                    Blog::BLOG_CATEGORY => 'string',
                    Blog::BLOG_SORTING => 'nullable|integer',
                    Blog::BLOG_STATUS => 'required|in:live,disabled',
                    Blog::IMAGE => 'nullable|image|mimes:jpeg,png,jpg',
                ];

            case 'update':
                return [
                    Blog::ID => 'required|exists:blogs,' . Blog::ID,
                    Blog::TITLE => 'required|string',
                    Blog::CONTENT => 'required|string',
                    Blog::BLOG_DATE => 'required|date',
                    Blog::BLOG_CATEGORY => 'string',
                    Blog::BLOG_SORTING => 'nullable|integer',
                    Blog::BLOG_STATUS => 'required|in:live,disabled',
                    Blog::IMAGE => 'nullable|image|mimes:jpeg,png,jpg',
                ];

            default:
                return [];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error($validator->getMessageBag()->first(),422));
    }
}
