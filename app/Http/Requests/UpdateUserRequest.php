<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'hoTen' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->id),
            ],
            'soDienThoai' => [
                'required',
                'numeric',
                Rule::unique('users')->ignore($this->id),
            ],
            'ngaySinh' => 'required|date',
            'diaChi' => 'required',
            'avatar' => 'image',
        ];
    }

    public function messages()
    {
        return [

            'hoTen.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email này đã đăng kí',
            'soDienThoai.required' => 'Số điện thoại không được để trống',
            'soDienThoai.unique' => 'Số điện thoại đã được đăng kí',
            'soDienThoai.numeric' => 'Số điện thoại phải là số',
            'ngaySinh.required' => 'Ngày sinh không được để trống',
            'ngaySinh.date' => 'Ngày sinh phải đúng định dạng',
            'diaChi.required' => 'Địa chỉ không được để trống',
            'avatar.image' => 'Phải nhập đúng định dạng ảnh',
        ];
    }
}
