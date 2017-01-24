<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
    	
    	$category = $this->route('category');
    	$id = $category ? $category->id : null;
        return [
            'name'	=>	"required|unique:categories,name,$id|max:255"
        ];
    }
    
    public function messages()
    {
    	/*return [
    		'name.required' => 	'O nome é obrigatório',
    		'name.unique'	=>	'O nome deve ser único'
    	];*/
    	
    	return [
    			'required' => 	'O :attribute é obrigatório',
    			'unique'	=>	'O :attribute deve ser único'
    	];
    }
    
    public function attributes ()
    {
    	return [
    		'name'	=>	'nome'	
    	];
    }
}
