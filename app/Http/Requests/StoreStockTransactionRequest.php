<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockTransactionRequest extends FormRequest
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
        $rules = [
            'product_id' => [
                'required',
                'exists:products,id',
                function($attribute, $value, $fail) {
                    $product = \App\Models\Product::find($value);
                    if ($product && $product->category && $product->category->deleted_at) {
                        $fail('Produk dari kategori yang diarsipkan tidak dapat dipilih untuk transaksi.');
                    }
                }
            ],
            'transaction_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ];

        if ($this->routeIs('transactions.in.store')) {
            $rules['supplier_id'] = 'required|exists:suppliers,id';
        }

        if ($this->routeIs('transactions.out.store')) {
            $rules['destination'] = 'required|string|max:150';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk wajib dipilih.',
            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
            'quantity.required' => 'Jumlah wajib diisi.',
            'quantity.min' => 'Jumlah minimal 1.',
            'supplier_id.required' => 'Supplier wajib dipilih untuk barang masuk.',
            'destination.required' => 'Tujuan wajib diisi untuk barang keluar.',
        ];
    }
}
