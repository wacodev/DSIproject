<?php

namespace DSIproject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocenteRequest extends FormRequest
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
            'user_id'          => 'required',
            'nip'              => 'required|min:10|max:10|unique:docentes,nip,' . $this->route('docente'),
            'especialidad'     => 'max:100',
            'nit'              => 'max:17',
            'nup'              => 'max:12',
            'isss'             => 'max:9',
            'fecha_nacimiento' => 'required',
            'direccion'        => 'max:400',
            'telefono'         => 'max:8',
            'idiomas'          => 'max:100',
            'imagen'           => 'image|mimes:jpeg,png,bmp|max:2048',
        ];
    }
}
