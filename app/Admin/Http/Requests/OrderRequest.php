<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
                //
                'user_id' => ['required', 'exists:App\Models\User,id'],
                'status' => ['required', 'in:0,1,2'],
                'product_id' => ['required'],
                'quantity' => ['required'],
                'price' => ['required'],
            ];
        }else{
            return [
                'id' => ['required', 'exists:App\Models\Order,id'],
                'user_id' => 'required',
                'status' => 'required'
            ];
        }
        
    }

    public function attributes() {
        return [
            'user_id' => 'Bàn',
            'product_id' => 'Món ăn',
        ];
    }

    public function messages() {
        return [
            'user_id.required' => ':attribute không được để trống',
            'user_id.exists' => ':attribute không tồn tại',
            'product_id.required' => ':attribute chưa chọn',
        ];
    }
}
