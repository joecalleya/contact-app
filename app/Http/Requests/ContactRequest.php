<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // logs current http method to screen
        //dd($this->method());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'required|string|max:50',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    // this function is for overriding the validation message
    public function attributes(){
        return [
                'company_id' => 'company',
                'email' => 'email address'
        ];
    }
    // this function is for overriding the validation message
    // the * says to us any cola
    public function messages(){
        return [
                'email.email' =>'the email you have entered is not valid',
                '*.required' =>':attribute cannot be empty',

        ];
    }
    // this function allows us to add additional layers into the validation
    // we might want to add calculated
    public function prepareForValidation(){
        $this->merge([
            //
        ]);
    }
}
