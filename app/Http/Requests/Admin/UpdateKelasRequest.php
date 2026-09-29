<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class UpdateKelasRequest extends FormRequest
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
            'mata_kuliah_id'        => 'required|exists:mata_kuliah,id',
            'tahun_akademik_id'     => 'required|exists:tahun_akademik,id',
            'kode_kelas'            => 'required',
            Rule::unique('kelas', 'kode_kelas')
                ->ignore($this->kelas->id)
                ->where(function ($query) {
                    return $query
                        ->where('mata_kuliah_id', $this->mata_kuliah_id)
                        ->where('tahun_akademik_id', $this->tahun_akademik_id);
                }),
            'nama_kelas'            => 'required',
            'kuota'                 => 'required|min:15',
            'deskripsi'             => 'nullable',
            'status'                => 'required|in:draft,aktif,selesai,nonaktif',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $kelas = $this->route('kelas');

        $response = redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->with('open_modal', 'formKelas' . $kelas->id);

        throw new \Illuminate\Http\Exceptions\HttpResponseException($response);
    }

    #[Override]
    public function messages(): array
    {
        return [
            'mata_kuliah_id.required'       => 'Mata kuliah wajib dipilih.',
            'mata_kuliah_id.exists'         => 'Mata kuliah yang dipilih tidak valid.',
            'tahun_akademik_id.required'    => 'Tahun akademik wajib dipilih.',
            'tahun_akademik_id.exists'      => 'Tahun akademik yang dipilih tidak valid.',
            'kode_kelas.required'           => 'Kode kelas wajib diisi.',
            'kode_kelas.unique'             => 'Kode kelas tersebut sudah digunakan pada mata kuliah dan tahun akademik yang dipilih.',
            'nama_kelas.required'           => 'Nama kelas wajib diisi.',
            'kuota.required'                => 'Kuota kelas wajib diisi.',
            'kuota.min'                     => 'Kuota kelas minimal 15 mahasiswa.',
            'status.required'               => 'Status kelas wajib dipilih.',
            'status.in'                     => 'Status kelas yang dipilih tidak valid.',
        ];
    }
}
