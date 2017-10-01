<div class="box-body">
    {!! Form::i18nInput('title', trans('portfolio::brands.form.title'), $errors, $lang, null, ['data-slug'=>'source']) !!}

    {!! Form::i18nInput('slug', trans('portfolio::brands.form.slug'), $errors, $lang, null, ['data-slug'=>'target']) !!}
</div>
