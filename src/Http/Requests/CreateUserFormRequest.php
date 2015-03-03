<?php namespace Freshwork\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserFormRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules()
    {
        return [
            'name'                                  => 'required',
            config('admin.auth.password_field')     => 'required',
            config('admin.auth.login_field')        => 'required',
        ];
    }


}