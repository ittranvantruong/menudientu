<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserRequest extends FormRequest
{
    //
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
                'name' => ['required', 'max:255', 'unique:App\Models\User,name'],
                'fullname' => ['required', 'max:255']
            ];
        }else{
            return [
                'id' => ['required', 'exists:App\Models\User,id'],
                'name' => ['required', 'max:255', 'unique:App\Models\User,name,'.$this->id],
                'fullname' => ['required', 'max:255']
            ];
        }
        
    }
    public function attributes(){
        return [
            'id' => 'Mã định danh',
            'name' => 'Mã bàn',
            'fullname' => 'Tên bàn',
        ];
    }
    public function messages(){
        return [
            'id.required' => ':attribute không được để trống', 
            'id.exists' => ':attribute không tồn tại', 
            'name.required' => ':attribute không được để trống', 
            'name.max' => ':attribute không được quá 255 ký tự', 
            'name.unique' => ':attribute đã được sử dụng', 
            'fullname.required' => ':attribute không được để trống', 
            'fullname.max' => ':attribute không được quá 255 ký tự', 
        ];
    }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if (!Str::of($this->name)->isAscii() || strpos($this->name, ' ')) {
                $validator->errors()->add('name', 'Không chứ các ký tự đặc biệt');
            }
        });
    }
}
