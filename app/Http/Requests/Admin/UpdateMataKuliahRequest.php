<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateMataKuliahRequest extends FormRequest
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
            'program_studi_id' => 'required|exists:prodi,id',
            'kode_mata_kuliah' => 'required|unique:mata_kuliah,kode_mata_kuliah,' . $this->route('mata_kuliah')->id,
            'nama_mata_kuliah' => 'required',
            'sks'              => 'required|min:1|max:6',
            'semester'         => 'required|min:1|max:14',
            'deskripsi'        => 'nullable',
            'is_active'        => 'required|in:0,1',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $mataKuliah = $this->route('mata-kuliah');

        $response = redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->with('open_modal', 'formMataKuliah' . $mataKuliah->id);

        throw new \Illuminate\Http\Exceptions\HttpResponseException($response);
    }

    #[Override]
    public function messages(): array
    {
        return [
            'program_studi_id.required'     => 'Program Studi wajib dipilih.',
            'program_studi_id.exists'       => 'Program Studi yang dipilih tidak valid.',
            'kode_mata_kuliah.required'     => 'Kode mata kuliah wajib diisi.',
            'kode_mata_kuliah.unique'       => 'Kode mata kuliah sudah digunakan.',
            'nama_mata_kuliah.required'     => 'Nama mata kuliah wajib diisi.',
            'sks.required'                  => 'SKS wajib diisi.',
            'sks.min'                       => 'SKS minimal 1.',
            'sks.max'                       => 'SKS maksimal 6.',
            'semester.required'             => 'Semester wajib diisi.',
            'semester.min'                  => 'Semester minimal 1.',
            'semester.max'                  => 'Semester maksimal 14.',
            'is_active.required'            => 'Status wajib dipilih.',
            'is_active.in'                  => 'Status tidak valid.',
        ];
    }
}
