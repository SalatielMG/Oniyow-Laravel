<?php

namespace oniyow\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaCreaCorreo extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "emailnuevo" => "required|email|unique:email,email",
        ];
    }
    public function messages()
    {
        return [
            'emailnuevo.unique' => 'El nuevo email ya existe en la base de datos, Porfavor Escriba un correo diferente',
        ];
    }
}
