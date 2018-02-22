@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('portfolio::portfolios.title.create portfolio') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.portfolio.portfolio.index') }}">{{ trans('portfolio::portfolios.title.portfolios') }}</a></li>
        <li class="active">{{ trans('portfolio::portfolios.title.create portfolio') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.portfolio.portfolio.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('portfolio::admin.portfolios.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-body">
                        {!! Form::normalInput('website', trans('portfolio::portfolios.form.website'), $errors, null, ['placeholder'=>'https://www.projelinki.com']) !!}
                        @mediaMultiple('portfolioImage', null, null, trans('portfolio::portfolios.form.images'))
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.portfolio.portfolio.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-2">
            @includeIf('portfolio::admin.portfolios.partials.settings')
            <div class="box">
                <div class="box-body">
                    {!! Form::normalSelect('category_id', trans('portfolio::categories.title.categories'), $errors, $selectCategories, null) !!}

                    {!! Form::normalSelect('brand_id', trans('portfolio::brands.title.brands'), $errors, [''=>'Seçiniz']+$selectBrands, null) !!}

                    <div class="form-group{{ $errors->has("start_at") ? ' has-error' : '' }}">
                        {!! Form::label("start_at", trans('portfolio::portfolios.form.start_at').':') !!}
                        <div class='input-group date' id='start_at'>
                            <input type="text" class="form-control" name="start_at" value="{{ old('start_at', Carbon::now()->format('d.m.Y')) }}" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                        {!! $errors->first("start_at", '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group{{ $errors->has("end_at") ? ' has-error' : '' }}">
                        {!! Form::label("end_at", trans('portfolio::portfolios.form.end_at').':') !!}
                        <div class='input-group date' id='end_at'>
                            <input type="text" class="form-control" name="end_at" value="{{ old('start_at', Carbon::now()->format('d.m.Y')) }}" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                        {!! $errors->first("end_at", '<span class="help-block">:message</span>') !!}
                    </div>

                    {!! Form::normalInput('ordering', trans('portfolio::brands.form.ordering'), $errors) !!}

                    {!! Form::normalCheckbox('status', trans('portfolio::brands.form.status'), $errors) !!}
                </div>
            </div>
            <div class="box">
                <div class="box-body">
                    @mediaSingle('portfolioLogo', null, null, trans('portfolio::portfolios.form.logo'))
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.portfolio.portfolio.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
            $('#start_at').datetimepicker({
                locale: '<?= App::getLocale() ?>',
                allowInputToggle: true,
                format: 'DD.MM.YYYY'
            });
            $('#end_at').datetimepicker({
                locale: '<?= App::getLocale() ?>',
                allowInputToggle: true,
                format: 'DD.MM.YYYY'
            });
        });
    </script>
@endpush
