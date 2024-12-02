<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:offers,id',
            'user_name' => 'required|string',
            'category_title' => 'required|string',
            'title' => 'required|string',
            'images' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'slug' => 'required|string',
            'created_at' => 'required|date',
        ];
    }
}
