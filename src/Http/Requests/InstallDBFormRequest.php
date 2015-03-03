<?php namespace Freshwork\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallDBFormRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules()
    {
        return [
            'db_host'       => 'required',
            'db_database'   => 'required',
            'db_username'   => 'required',
            'db_password'   => 'required',
        ];
    }


}