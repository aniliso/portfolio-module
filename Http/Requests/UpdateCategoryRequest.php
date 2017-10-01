<?php

namespace Modules\Portfolio\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'portfolio::categories.form';
    public function rules()
    {
        return [
            'ordering' => 'required|integer'
        ];
    }

    public function translationRules()
    {
        $id = $this->route()->parameter('portfolioCategory')->id;

        return [
            'title' => 'required|max:200',
            'slug'  => "required|max:200|unique:portfolio__category_translations,slug,$id,category_id,locale,$this->localeKey"
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
