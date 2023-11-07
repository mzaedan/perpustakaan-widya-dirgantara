<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kode_peminjaman|string',
            // 'id_anggota|required|integer',
            // 'id_buku|required|integer',
            'status|string',
            'tanggal_peminjaman|string',
            // 'lama_peminajaman|required|integer',
            'tanggal_harus_dikembalikan|string',
            'tanggal_kembali|string',
        ];
    }
}
