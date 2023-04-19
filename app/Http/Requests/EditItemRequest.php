<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditItemRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'item_name' => 'required',
            'price' => 'required | numeric'
        ];
    }
}
