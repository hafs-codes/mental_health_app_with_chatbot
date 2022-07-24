<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
class AdminFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' =>'required',
            'lastname' =>'required',
            'email' =>'required',
            'phonenumber' =>'required',
            'password' =>'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'firstname'=>strip_tags($this->firstname),
            'lastname'=>strip_tags($this->lastname),
            'email'=>strip_tags($this->email),
            'phonenumber'=>strip_tags($this->phonenumber),
            'password'=>Hash::make(strip_tags($this->password)),
            
        ]);
    }

}
