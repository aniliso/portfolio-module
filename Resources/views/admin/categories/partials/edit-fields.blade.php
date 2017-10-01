<div class="box-body">
    {!! Form::i18nInput('title', trans('portfolio::categories.form.title'), $errors, $lang, $category, ['data-slug'=>'source']) !!}

    {!! Form::i18nInput('slug', trans('portfolio::categories.form.slug'), $errors, $lang, $category, ['data-slug'=>'target']) !!}
</div>
