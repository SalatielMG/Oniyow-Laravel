<?php

namespace oniyow\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaCreateMateria extends FormRequest
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
     * 'razonSocial' => 'required|string|max:100',
    'representanteLegal' => 'required|string|max:200',
    'sitioWeb' => 'max:200',
    'domicilioParticular' => 'required|string|max:255',
    'usuario' => 'required|string|max:100',
    'password' => 'required|string|min:6|confirmed',
     * @return array
     */
    public function rules()
    {
        return [
            "nombre"=>"required",
            "descripcion"=>"required",
            "stock" => "required|numeric",
            "unidadmedida" => "required",
            "imagen" => "image"
        ];
    }
}
