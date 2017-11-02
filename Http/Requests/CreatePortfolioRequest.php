<?php

namespace Modules\Portfolio\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreatePortfolioRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'portfolio::portfolios.form';

    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'brand_id'    => 'required|integer',
            'ordering'    => 'required|integer',
            'start_at'    => 'required|date_format:d.m.Y',
            'end_at'      => 'required|date_format:d.m.Y',
            'website'     => 'url'
        ];
    }

    public function attributes()
    {
        return trans('portfolio::portfolios.form');
    }

    public function translationRules()
    {
        return [
            'title'       => 'required|max:200',
            'slug'        => 'required|max:200',
            'description' => 'required'
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