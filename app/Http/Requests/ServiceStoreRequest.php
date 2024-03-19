<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->isMethod('post')){
        return [
            'nom'=>'required|string|max:258',
            'description'=>'required|string|max:258',
        ];
    }else{
        return[
            'nom'=>'required|string|max:258',
            'description'=>'required|string|max:258',
        ];
    }
}
 public function messages(){
    if(request()->isMethod('post')){
        return[
            'nom.required'=>'Le nom est obligatoire',
            'description.required'=>'La description est obligatoire'];

 }else {

 return[
                'nom.required'=>'Le nom est obligatoire',
                'description.required'=>'La description est obligatoire'];
}
}}