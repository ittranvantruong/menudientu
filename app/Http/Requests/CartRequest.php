<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST'){
            return [
                'id' => ['required', 'exists:App\Models\Product,id'],
                'size' => ['required', 'in:M,L'],
                'quantity' => ['required', 'integer', 'min:1']
            ];
        }else{
            return [
                'size' => ['required', 'in:M,L'],
                'quantity' => ['required', 'integer', 'min:1']
            ];
        }
        
    }
}
