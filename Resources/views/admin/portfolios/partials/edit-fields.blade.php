<div class="box-body">
    {!! Form::i18nInput('title', trans('portfolio::portfolios.form.title'), $errors, $lang, $portfolio, ['data-slug'=>'source']) !!}

    {!! Form::i18nInput('slug', trans('portfolio::portfolios.form.slug'), $errors, $lang, $portfolio, ['data-slug'=>'target']) !!}

    @editor('description', trans('portfolio::portfolios.form.description'), old("{$lang}.description", $portfolio->description), $lang)
</div>

<div class="box-body">
    <div class="box-group" id="accordion">
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{$lang}}">
                        {{ trans('portfolio::portfolios.form.meta_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseTwo-{{$lang}}" class="panel-collapse collapse">
                <div class="box-body">
                    {!! Form::i18nInput("meta_title", trans('portfolio::portfolios.form.meta_title'), $errors, $lang, $portfolio) !!}

                    {!! Form::i18nInput("meta_description", trans('portfolio::portfolios.form.meta_description'), $errors, $lang, $portfolio) !!}
                </div>
            </div>
        </div>
    </div>
</div>
