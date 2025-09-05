<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StudentRequest extends FormRequest
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
    public function rules(): array
    {
 
        // هل الطلب فيه ID؟ يعني بنعمل update
        $studentId = $this->route('id'); // من الراوت /students/{id}

        return [
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                $studentId
                    ? Rule::unique('students', 'email')->ignore($studentId)
                    : Rule::unique('students', 'email')
            ],
            'phone' => ['nullable', 'regex:/^(010|011|012|015)[0-9]{8}$/'],
            'photo' =>['nullable','image','mimes:png,jpg'],
            'department_id' => ['integer'],
        ];




        // return [
        //     'name' =>['required'],
        //     'email'=>['required','email','unique:students,email'],
        //     'phone'=>['nullable','regex:/^(010|011|012|015)[0-9]{8}/'],
        //     'photo' =>['nullable','image','mimes:png,jpg'],
        //     'department_id' =>['integer'],

        // ];
    }

    public function messages()
    { 
        
        return [
                
                "name.required" =>'please enter your name ^_^',
                "email.required" =>'please enter your email ^_^',
                "email.email" =>'please enter valid email ^_^',
                "email.unique" =>'exist email ..please enter new email ^_^',

        ];
    }
}
