<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'code' => ['required', 'string', 'max:30', 'unique:activities,code'],
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'capacity' => ['required', 'integer', 'min:1', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak tersedia.',
            'code.required' => 'Kode kegiatan wajib diisi.',
            'code.unique' => 'Kode kegiatan sudah digunakan.',
            'title.required' => 'Judul wajib diisi.',
            'title.min' => 'Judul minimal 5 karakter.',
            'title.max' => 'Judul maksimal 100 karakter.',
            'location.required' => 'Lokasi wajib diisi.',
            'start_at.required' => 'Tanggal mulai wajib diisi.',
            'start_at.date' => 'Format tanggal mulai tidak valid.',
            'end_at.required' => 'Tanggal selesai wajib diisi.',
            'end_at.date' => 'Format tanggal selesai tidak valid.',
            'end_at.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'capacity.required' => 'Kapasitas wajib diisi.',
            'capacity.integer' => 'Kapasitas harus berupa bilangan bulat.',
            'capacity.min' => 'Kapasitas minimal 1.',
            'capacity.max' => 'Kapasitas maksimal 500.',
        ];
    }
}