<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function attributes()
    {
        return [
            'code' => 'Mã nhân viên',
            'name' => 'Họ và tên nhân viên',
            'date_of_birth' => 'Ngày sinh',
            'cccd' => 'CCCD',
            'email' => 'Email',
            'address' => 'Địa chỉ',
            'phone_number' => 'Số điện thoại',
            'account_code' => 'Mã tài khoản',
            'password' => 'Mật khẩu',
        ];
    }
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'cccd' => 'required|numeric|digits:12',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:10,11',
            'account_code' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc.',
            'string' => ':attribute phải là một chuỗi ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'date_format' => ':attribute không đúng định dạng Y-m-d.',
            'numeric' => ':attribute phải là một số.',
            'digits' => ':attribute phải có :digits chữ số.',
            'email' => ':attribute phải là một địa chỉ email hợp lệ.',
            'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
            'min' => ':attribute phải ít nhất :min ký tự.',
        ];
    }
}
