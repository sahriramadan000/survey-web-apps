<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_available' => filter_var($this->is_available, FILTER_VALIDATE_BOOLEAN),
            'is_active' => filter_var($this->is_active, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'is_available' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',

            // Gambar
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // PDF
            'pdf1' => 'nullable|file|mimes:pdf|max:5120',
            'pdf2' => 'nullable|file|mimes:pdf|max:5120',
            'pdf3' => 'nullable|file|mimes:pdf|max:5120',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk maksimal 100 karakter.',

            'description.string' => 'Deskripsi harus berupa teks.',

            'product_category_id.required' => 'Kategori produk wajib dipilih.',
            'product_category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'is_available.boolean' => 'Status ketersediaan harus berupa nilai benar atau salah.',
            'is_active.boolean' => 'Status aktif harus berupa nilai benar atau salah.',

            'image1.image' => 'Gambar 1 harus berupa file gambar.',
            'image1.mimes' => 'Gambar 1 harus bertipe jpeg, png, jpg, gif, svg, atau webp.',
            'image1.max' => 'Ukuran Gambar 1 tidak boleh lebih dari 2MB.',

            'image2.image' => 'Gambar 2 harus berupa file gambar.',
            'image2.mimes' => 'Gambar 2 harus bertipe jpeg, png, jpg, gif, svg, atau webp.',
            'image2.max' => 'Ukuran Gambar 2 tidak boleh lebih dari 2MB.',

            'image3.image' => 'Gambar 3 harus berupa file gambar.',
            'image3.mimes' => 'Gambar 3 harus bertipe jpeg, png, jpg, gif, svg, atau webp.',
            'image3.max' => 'Ukuran Gambar 3 tidak boleh lebih dari 2MB.',

            'image4.image' => 'Gambar 4 harus berupa file gambar.',
            'image4.mimes' => 'Gambar 4 harus bertipe jpeg, png, jpg, gif, svg, atau webp.',
            'image4.max' => 'Ukuran Gambar 4 tidak boleh lebih dari 2MB.',

            'pdf1.file' => 'File PDF 1 harus berupa file.',
            'pdf1.mimes' => 'File PDF 1 harus bertipe PDF.',
            'pdf1.max' => 'Ukuran PDF 1 tidak boleh lebih dari 5MB.',

            'pdf2.file' => 'File PDF 2 harus berupa file.',
            'pdf2.mimes' => 'File PDF 2 harus bertipe PDF.',
            'pdf2.max' => 'Ukuran PDF 2 tidak boleh lebih dari 5MB.',

            'pdf3.file' => 'File PDF 3 harus berupa file.',
            'pdf3.mimes' => 'File PDF 3 harus bertipe PDF.',
            'pdf3.max' => 'Ukuran PDF 3 tidak boleh lebih dari 5MB.',
        ];
    }
}
