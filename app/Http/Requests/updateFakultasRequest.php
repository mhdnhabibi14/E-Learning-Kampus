<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class updateFakultasRequest extends FormRequest
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
            'kode_fakultas' => 'required|unique:fakultas,kode_fakultas,' . $this->route('fakultas')->id,
            'nama_fakultas' => 'required|unique:fakultas,nama_fakultas,' . $this->route('fakultas')->id,
            'deskripsi'     => 'nullable',
            'is_active'     => 'required|in:0,1',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $fakultas = $this->route('fakultas');
        $response = redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->with('open_modal', 'formFakultas' . $fakultas->id);
        throw new \Illuminate\Http\Exceptions\HttpResponseException($response);
    }

    public function messages(): array
    {
        return [
            'kode_fakultas.required'    => 'Kode Fakultas wajib diisi.',
            'kode_fakultas.unique'      => 'Kode Fakultas sudah digunakan.',
            'nama_fakultas.required'    => 'Nama Fakultas wajib diisi.',
            'nama_fakultas.unique'      => 'Nama Fakultas sudah digunakan.',
            'is_active.required'        => 'Status wajib dipilih.',
            'is_active.in'              => 'Status tidak valid. Pilih antara Aktif atau Tidak Aktif.',
        ];
    }
}
