<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_notes' => 'nullable|string',
            'payment_method' => 'required|in:cod,transfer',
            
            // Validasi keranjang: opsional book_id tunggal (beli langsung) 
            // atau array items untuk checkout keranjang
            'book_id' => 'nullable|exists:books,id',
            
            'items' => 'required_without:book_id|array',
            'items.*.cart_id' => 'required_with:items|exists:carts,id',
            'items.*.quantity' => 'required_with:items|integer|min:1',
        ];
    }
}
