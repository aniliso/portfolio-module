@include('portfolio::admin.portfolios.partials.settings.text-field', [
    'fields'=>['describe'=>'text', 'employer'=>'text', 'tech_desc'=>'textarea'],
    'labels'=>['describe'=>'Tanım', 'employer'=>'İşveren', 'tech_desc'=>'Teknik Açıklama']
])

<div class="box-body">
    <div class="form-group{{ $errors->has("settings.location") ? ' has-error' : '' }}">
        {!! Form::label("settings.location", "Lokasyon".':') !!}
        {!! Form::input('text', 'settings[location]', !isset($portfolio->settings->location) ? '' : $portfolio->settings->location, ['class'=>'form-control']) !!}
        {!! $errors->first("settings.location", '<span class="help-block">:message</span>') !!}
    </div>
</div>

@push('js-stack')
<script>
    $( document ).ready(function() {
        $(".textarea").wysihtml5();
    });
</script>
@endpush