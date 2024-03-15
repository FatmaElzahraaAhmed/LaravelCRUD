<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','min:10'],
            'body'=>['required'],
            'enabled'=>['nullable', 'boolean'], 
            'published_at'=>['required'],
            'user_id'=>['required']
        ];
    }

    public function attributes(): array
    {
        return [
            'enabled' => 'enabled (status)',
            'published_at' => 'published at'
        ];
    }
}
