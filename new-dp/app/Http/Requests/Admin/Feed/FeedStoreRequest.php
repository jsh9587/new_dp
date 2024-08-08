<?php

namespace App\Http\Requests\Admin\Feed;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class FeedStoreRequest extends FormRequest
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
            //
            'type' => 'required|string',
//            'user_id' => 'required|integer',
            'title' => 'required|string',
            'slug' => 'required|string',
            'content' => 'required|string',
            'media_url' => 'nullable|string'
        ];
    }

    /**
     * Prepare the data for validation.
     */
//    protected function prepareForValidation(): void
//    {
//        $this->merge([
//            'slug' => Str::slug($this->slug),
//        ]);
//    }
}
