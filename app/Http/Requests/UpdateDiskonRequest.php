<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiskonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tipe'=> 'nullable|exists:tipe_kamars,tipe',
            'kode'=> 'required|exists:diskons,kode',
            'kode_kamar'=> 'nullable|exists:kamars,kode',
            'potongan'=> 'required|max:100',
            'tgl_mulai'=> 'required|date',
            'tgl_akhir'=> 'required|date',
        ];
    }
}
