<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserReqeust extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'role_id' =>['exists:roles,id']
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống',
            'username.min' => 'Độ dài tối thiểu là 6 kí tự',
            'password.min' => 'Độ dài tối thiểu là 8 kí tự',
            'max' => 'Độ dài tối đa là 255 kí tự',
            'username.unique' => 'Tên này đã tồn tại',
            'password.confirmed' => 'Mật khẩu bạn nhập không khớp',
            'role.exists' => "Quyền bạn chọn k tồn tại",
        ];
    }
}
