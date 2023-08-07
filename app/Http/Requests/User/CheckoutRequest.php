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
            'kode_kamar'=> 'required|exists:kamars,kode',
            'diskon'=> 'nullable|numeric',
            'sub_total'=> 'required',
            'status'=> 'required|in_array:PENDING,SUCCESS',
            'tgl_masuk'=> 'required|date',
            'tgl_keluar'=> 'required|date',
            'jumlah_tamu'=> 'required|numeric'
        ];
    }
}
