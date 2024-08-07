<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKamarRequest extends FormRequest
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
            'tipe_kamar'=> 'required|exists:tipe_kamars,tipe',
            // 'kode'=> 'required|unique:kamars,kode',
            'ruangan'=> 'required|unique:kamars,ruangan',
            // 'status'=>
            // 'foto'=> 'required|image|mimes:png,jpg|max:1020',
            'fasilitas'=> 'required|array',
            'ket'=> 'required|string|max:255'
        ];
    }
}
