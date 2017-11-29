<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
        $rules = [
            'titulo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required'
        ];

        $imagenes = count($this->input('imagenes'));

        foreach(range(0, $imagenes) as $index) {
            $rules['imagenes.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
        }

        return $rules;
    }
}
