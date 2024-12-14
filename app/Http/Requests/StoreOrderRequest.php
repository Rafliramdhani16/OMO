<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'size_id' => ['required', 'integer', 'exists:shirt_sizes,id'],
            'shirt_id' => ['required', 'integer', 'exists:shirts,id']
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'size_id.required' => 'Silahkan pilih ukuran',
            'size_id.integer' => 'Format ukuran tidak valid',
            'size_id.exists' => 'Ukuran yang dipilih tidak tersedia',
            'shirt_id.required' => 'ID produk diperlukan',
            'shirt_id.integer' => 'Format ID produk tidak valid',
            'shirt_id.exists' => 'Produk tidak ditemukan',
        ];
    }
}