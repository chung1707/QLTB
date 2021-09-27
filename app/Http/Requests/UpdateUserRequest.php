<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|string',
            'username' => ['required', 'min:3', 'max:255', 'string', Rule::unique('users','username')->ignore($this->user)],
            'employee_id' => ['nullable',],
            'role_id' => ['required', 'exists:roles,id'],
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
            'role.exists' => "Quyền bạn chọn k tồn tại",
            'integer' => "Trường yêu cầu giá trị là số nguyên"
        ];
    }
}

