<?php

namespace oniyow\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaCreaDatoFiscal extends FormRequest
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
     ** Get the validation rules that apply to the request.
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
            "rfc" => "required|string|max:13",
            "calle" => "required|string|max:100",
            "ninterior" => "required|string|max:4",
            "nexterior" => "max:4",
            "colonia" => "required|string|max:50",
            "cp" => "required|digits:5",
            "municipio" => "required|string|max:100",
            "estado" => "required|string|max:50",
            "emails" => 'Integer|Min:1',
            "telefonos" => 'Integer|Min:1',
        ];

    }
}
