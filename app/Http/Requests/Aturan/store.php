<?php

namespace App\Http\Requests\Aturan;

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
            'kode' => 'required',
            'himpunan_id' => 'required',
            'keputusan_id' => 'required',
            'mb' => 'required',
            'md' => 'required',
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
            'keputusan_id.required' => 'Field keputusan wajib diisi',
            'himpunan_id' => "Field himpunan wajib diisi",
            'kode.required' => 'Field kode wajib diisi',
            'mb.required' => 'Field MB wajib diisi',
            'md.required' => 'Field MD wajib diisi',
        ];
    }
}
