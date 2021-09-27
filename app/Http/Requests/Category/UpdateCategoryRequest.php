<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:255', 'string', Rule::unique('categories','name')->ignore($this->category)],
            'description' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống',
            'min' => 'Độ dài tối thiểu là 6 kí tự',
            'max' => 'Độ dài tối đa là 255 kí tự',
            'unique' => 'Tên danh mục này đã tồn tại',
            'string' => "Trường này phải là một chuỗi kí tự",
        ];
    }
}
