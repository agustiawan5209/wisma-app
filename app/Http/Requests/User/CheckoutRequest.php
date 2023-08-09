<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'tipe'=> 'required|exists:tipe_kamars,tipe',
            'kode_kamar'=> 'required|exists:kamars,kode',
            'diskon'=> 'nullable|numeric',
            'status'=> 'required',
            'tgl_masuk'=> 'required|date',
            'tgl_keluar'=> 'required|date',
            'jumlah_tamu'=> 'required|numeric',
            'sub_total'=> 'required|numeric',

            // Metode Bayar,
            'metode_bayar'=> 'required',
            'user_email'=> 'required|email',
            'user_name'=> 'required|exists:users,name',
            'user_no_hp'=> 'required|numeric',
            'ket'=> 'required|string|max:100',
        ];
    }
}
