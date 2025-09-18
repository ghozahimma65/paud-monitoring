<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id'); // ambil id dari route kalau update

        return [
            'nama' => 'required|string|max:255',
            'nis' => [
                'required',
                'string',
                'max:50',
                Rule::unique('siswas', 'nis')->ignore($id), // abaikan kalau update dirinya sendiri
            ],
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'wali_id' => 'required|exists:wali_murids,id',
            'foto' => 'nullable|string',
        ];
    }
}
