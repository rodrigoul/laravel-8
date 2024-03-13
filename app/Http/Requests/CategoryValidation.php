<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CategoryValidation 
{
    private $itemData;
    
    public function __construct($data)
    {   
        $this->itemData = $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function validate()
    {  
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'name.unique' => 'Este nome já está em uso.'
        ];

        if (isset($this->itemData['id'])) {
            $uniqueRule = Rule::unique('categories', 'name')->ignore($this->itemData['id']);
        } else {
            $uniqueRule = 'unique:categories,name';
        }

        return validator($this->itemData, [
            'name' => [
                'required',
                'string',
                'max:50',
                $uniqueRule,
            ],
        ], $messages)->validate();
    }
}
