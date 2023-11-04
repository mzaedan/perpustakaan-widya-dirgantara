<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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
            'nama' => 'required|string',
            'id_kategori' => 'required|integer',
            'id_rak' => 'required|integer',
            // 'kode_buku' => 'required|string',
            'tahun_buku' => 'integer',
            'isbn' => 'string',
            'penerbit' => 'string',
            'pengarang' => 'string',
            'sampul' => 'image',
            'lampiran' => 'file|mimes:pdf,docx,doc',
            'jumlah' => 'integer'
        ];
    }
}
