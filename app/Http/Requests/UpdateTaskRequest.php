<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['nullable', 'max:255'],
            'description' => ['nullable'],
            'status' => ['nullable', Rule::in(['open', 'failed', 'completed'])],
            'due_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
