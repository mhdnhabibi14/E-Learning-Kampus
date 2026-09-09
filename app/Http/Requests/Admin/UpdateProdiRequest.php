<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProdiRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'fakultas_id'   => 'required|exists:fakultas,id',
            'kode_prodi'    => 'required|unique:prodi,kode_prodi,' . $this->route('prodi')->id,
            'nama_prodi'    => 'required|unique:prodi,nama_prodi,' . $this->route('prodi')->id,
            'jenjang'       => 'required|in:S1,S2,S3,D3,D4',
            'deskripsi'     => 'nullable',
            'is_active'     => 'required|in:0,1'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $prodi = $this->route('prodi');

        $response = redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->with('open_modal', 'formProdi' . $prodi->id);

        throw new \Illuminate\Http\Exceptions\HttpResponseException($response);
    }

    public function messages(): array
    {
        return [
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
            'fakultas_id.exists' => 'Fakultas yang dipilih tidak valid.',
            'kode_prodi.required' => 'Kode Program Studi wajib diisi.',
            'kode_prodi.unique' => 'Kode Program Studi sudah digunakan.',
            'nama_prodi.required' => 'Nama Program Studi wajib diisi.',
            'nama_prodi.unique' => 'Nama Program Studi sudah digunakan.',
            'jenjang.required' => 'Jenjang wajib dipilih.',
            'jenjang.in' => 'Jenjang tidak valid. Pilih antara S1, S2, S3, D3, atau D4.',
            'is_active.required' => 'Status wajib dipilih.',
            'is_active.in' => 'Status tidak valid. Pilih antara Aktif atau Tidak Aktif.',
        ];
    }
}
