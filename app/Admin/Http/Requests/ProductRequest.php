<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
                'name' => ['required', 'max:255'],
                'status' => ['required', 'in:0,1'],
                'price' => ['required', 'numeric'],
                'price_large' => ['nullable', 'numeric', 'gt:price'],
                'quantity' => ['required', 'integer'],
                'unit' => ['required', Rule::in(collect(config('mevivu.unit'))->keys()->all())],
                'category_id' => ['required', 'exists:App\Models\Category,id']
            ];
        }else{
            return [
                'id' => ['required', 'exists:App\Models\Category,id'],
                'name' => ['required', 'max:255'],
                'status' => ['required', 'in:0,1'],
                'price' => ['required', 'numeric'],
                'price_large' => ['nullable', 'numeric', 'gt:price'],
                'quantity' => ['required', 'integer'],
                'unit' => ['required', Rule::in(collect(config('mevivu.unit'))->keys()->all())],
                'category_id' => ['required', 'exists:App\Models\Category,id']
            ];
        }
        
    }
    public function attributes(){
        return [
            'id' => 'Mã món ăn',
            'name' => 'Tên món ăn',
            'status' => 'Trạng thái',
            'price' => 'Giá',
            'price_large' => 'Giá size lớn',
            'quantity' => 'Số lượng trong món ăn',
            'unit' => 'Đơn vị'
        ];
    }
    public function messages(){
        return [
            'id.required' => ':attribute không được để trống', 
            'id.exists' => ':attribute không tồn tại', 
            'name.required' => ':attribute không được để trống', 
            'name.required' => ':attribute không được quá 255 ký tự', 
            'status.required' => ':attribute không được để trống', 
            'status.integer' => ':attribute phải là số', 
            'price.required' => ':attribute Không được để trống',
            'price.numeric' => ':attribute phải là số',
            'price_large.required' => ':attribute Không được để trống',
            'price_large.numeric' => ':attribute phải là số',
            'price_large.gt' => ':attribute Phải lowns hơn giá mặc định',
            'quantity.required' => ':attribute Không được để trống',
            'quantity.integer' => ':attribute phải là số',
            'unit.required' => ':attribute Không được để trống',
            'unit.in' => ':attribute Không có trong dữ liệu đã cho',
        ];
    }
}
