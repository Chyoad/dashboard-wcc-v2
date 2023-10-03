<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string:max:20',
            'host' => 'required|string|max:20',
            'username' => 'required|string:max:20',
            'password' => 'required|string:min:5',
            'port' => 'required|string:max:5',
            // 'slug' => 'required',
        ];
    }
}
