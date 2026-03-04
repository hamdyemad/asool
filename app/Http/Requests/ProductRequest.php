<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        if ($this->isMethod('post')) {
            $rules['main_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['other_images.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['main_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['other_images.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
}
