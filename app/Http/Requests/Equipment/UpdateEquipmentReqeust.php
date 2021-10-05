<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentReqeust extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'device_code' => ['required', 'string', 'min:7', 'max:255', Rule::unique('equipment','device_code')->ignore($this->equipment)],
            'price' => ['required', 'numeric'],
            'quantity' =>['required','numeric'],
            'supplier_id' =>['exists:suppliers,id'],
            'category_id' =>['exists:categories,id'],
            'description' =>['nullable'],
            'thumbnail' =>['nullable'],
            'thumbnails' =>['nullable'],
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống',
            'min' => 'Độ dài tối thiểu là 7 kí tự',
            'max' => 'Độ dài tối đa là 255 kí tự',
            'device_code.unique' => 'Tên này đã tồn tại',
            'password.confirmed' => 'Mật khẩu bạn nhập không khớp',
            'supplier_id.exists' => "Nhà cung cấp bạn chọn k tồn tại",
            'category_id.exists' => "Nhà cung cấp bạn chọn k tồn tại",
            'image' => 'Tệp được tải lên phải là hình ảnh',
            'device_code.unique' => "Mã sản phẩm này đã được sử dụng",
        ];
    }
}
