<?php

namespace App\Http\Requests\Himpunan;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'variabel_id' => 'required',
            'nama' => 'required',
            'domain' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'variabel_id.required' => 'Field variabel wajib diisi',
            'nama.required' => 'Field nama wajib diisi',
            'domain\.required' => "Field batas wajib diisi"
        ];
    }
}
