@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('portfolio::brands.title.edit brand') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.portfolio.brand.index') }}">{{ trans('portfolio::brands.title.brands') }}</a></li>
        <li class="active">{{ trans('portfolio::brands.title.edit brand') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.portfolio.brand.update', $brand->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('portfolio::admin.brands.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                        <div class="box-body">
                            {!! Form::normalInput('website', trans('portfolio::brands.form.website'), $errors, $brand, ['placeholder'=>'http://www.markalinki.com']) !!}
                        </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.portfolio.brand.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-2">
            <div class="box">
                <div class="box-body">
                    {!! Form::normalInput('ordering', trans('portfolio::brands.form.ordering'), $errors, $brand) !!}

                    {!! Form::normalCheckbox('status', trans('portfolio::brands.form.status'), $errors, $brand) !!}

                    @mediaSingle('portfolioBrandImage', $brand, null, trans('portfolio::brands.form.image'))
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
                    { key: 'b', route: "<?= route('admin.portfolio.brand.index') ?>" }
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
        });
    </script>
@endpush
