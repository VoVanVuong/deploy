<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'hoTen'             => 'required',
            'email'             => 'required|unique:users|required',
            'password'          => 'required|min:6',
            'soDienThoai'       => 'required|unique:users|required|numeric',
            'ngaySinh'          => 'required|date',
            'diaChi'            => 'required',
            'avatar'            => 'required|image',
            'trangThai'         => 'required',
            'phanQuyen'         => 'required',


        ];
    }

    public function messages() {
        return [

            'hoTen.required'    => 'Tên không được để trống',
            'email.required'    => 'Email không được để trống',
            'email.unique'      => 'Email này đã đăng kí',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min'      => 'Mật khẩu phải lớn hơn 6 kí tự',
            'soDienThoai.required' => 'Số điện thoại không được để trống',
            'soDienThoai.unique'  => 'Số điện thoại đã được đăng kí',
            'soDienThoai.numeric' => 'Số điện thoại phải là số',
            'ngaySinh.required'   => 'Ngày sinh không được để trống',
            'ngaySinh.date'       => 'Ngày sinh phải đúng định dạng',
            'diaChi.required'     => 'Địa chỉ không được để trống',
            'avatar.required'     => 'Hình ảnh không được để trống',
            'avatar.image'        => 'Phải nhập đúng định dạng ảnh',
            'trangThai.required'  => 'Trạng thái không được để trống',
            'phanQuyen.required'  => 'Phân quyền không được để trống',
        ];
    }
}
