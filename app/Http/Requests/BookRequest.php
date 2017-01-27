<?php

namespace CodePub\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'		=>	"required|unique:books,title|max:255",
        	'subtitle'	=>	"required|max:255",
        	'price'		=>	"required|numeric"
        ];
    }
    
    public function messages()
    {
    	/*return [
    	 'name.required' => 	'O nome é obrigatório',
    	 'name.unique'	=>	'O nome deve ser único'
    	 ];*/
    	 
    	return [
    			'required' 	=> 	'O :attribute é obrigatório',
    			'unique'	=>	'O :attribute deve ser único',
    			'max'		=>	'O :attribute deve conter no máximo 255 caractéres'
    	];
    }
    
    public function attributes ()
    {
    	return [
    			'title'		=>	'Título',
    			'subtitle'	=>	'Subtítulo',
    			'price'		=>	'Valor'
    	];
    }
}
