<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class editCatRequest extends FormRequest
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
            'name' => [
                'required',
                // Rule::unique('App\Models\Category,name')->ignore($user->id),
            ]
        ];
    }

    //custom
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên Danh Mục',
            'name.unique' => 'Danh mục đã tồn tại'
        ];
    }
}
