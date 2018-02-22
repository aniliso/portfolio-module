<?php

namespace Modules\Portfolio\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateBrandRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'portfolio::brands.form';
    public function rules()
    {
        return [
            'ordering' => 'required|integer',
            //'website'  => 'url'
        ];
    }

    public function translationRules()
    {
        $id = $this->route()->parameter('portfolioBrand')->id;

        return [
            'title' => 'required|max:200',
            'slug'  => "required|max:200|unique:portfolio__brand_translations,slug,$id,brand_id,locale,$this->localeKey"
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'website' => 'Website adresini yanlış girdiniz'
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
