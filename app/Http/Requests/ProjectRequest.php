<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:80',
            'url' => 'nullable|max:80|url',
            'github_url' => 'nullable|max:80|url',
            'thumbnail' => 'nullable|image:jpg:jpeg:png:webp',
            'description' => 'required',
        ];
    }
}
