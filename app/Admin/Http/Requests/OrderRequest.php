<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            //
            'user_id' => ['required', 'exists:App\Models\User,id'],
            'product' => ['required'],
        ];
    }

    public function attributes() {
        return [
            'user_id' => 'Bàn',
            'product' => 'Món ăn',
        ];
    }

    public function messages() {
        return [
            'user_id.required' => ':attribute không được để trống',
            'user_id.exists' => ':attribute không tồn tại',
            'product.required' => ':attribute chưa chọn',
        ];
    }
}
