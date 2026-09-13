<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTahunAkademikRequest extends FormRequest
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
            'kode_tahun_akademik'   => 'required|unique:tahun_akademik,kode_tahun_akademik,' . $this->route('tahun_akademik')->id,
            'nama_tahun_akademik'   => 'required',
            'semester'              => 'required|in:Ganjil,Genap',
            'tanggal_mulai'         => 'required',
            'tanggal_selesai'       => 'required|after_or_equal:tanggal_mulai',
            'is_active'             => 'required|in:0,1',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $tahunAkademik = $this->route('tahun-akademik');

        $response = redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->with('open_modal', 'formTahunAkademik' . $tahunAkademik->id);

        throw new \Illuminate\Http\Exceptions\HttpResponseException($response);
    }

    public function messages(): array
    {
        return [
            'kode_tahun_akademik.required'      => 'Kode tahun akademik wajib diisi.',
            'kode_tahun_akademik.unique'        => 'Kode tahun akademik sudah digunakan.',
            'nama_tahun_akademik.required'      => 'Nama tahun akademik wajib diisi.',
            'semester.required'                 => 'Semester wajib dipilih.',
            'semester.in'                       => 'Semester harus Ganjil atau Genap.',
            'tanggal_mulai.required'            => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required'          => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after_or_equal'    => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'is_active.required'                => 'Status wajib dipilih.',
            'is_active.in'                      => 'Status harus berupa nilai aktif atau tidak aktif.',
        ];
    }
}
