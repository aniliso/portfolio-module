<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach(LaravelLocalization::getSupportedLocales() as $locale => $language)
                <li class="{{ $loop->first ? 'active' : '' }}"><a href="#text_field_{{ $locale }}" data-toggle="tab">{{ $language['native'] }}</a></li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach(LaravelLocalization::getSupportedLocales() as $locale => $language)
                <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="text_field_{{ $locale }}">
                    @foreach($fields as $key => $field)
                        @if($field=="textarea")
                            <div class="form-group{{ $errors->has("settings.slogan") ? ' has-error' : '' }}">
                                {!! Form::label("settings.{$key}.{$locale}", $labels[$key].':') !!}
                                {!! Form::textarea('settings['.$key.']['.$locale.']', old('settings.'.$key.'.'.$locale, $portfolio->settings->{$key}->{$locale} ?? ''), ['class'=>'form-control textarea']) !!}
                                {!! $errors->first("settings.'.$key.'.".$locale, '<span class="help-block">:message</span>') !!}
                            </div>
                        @else
                            <div class="form-group{{ $errors->has("settings.slogan") ? ' has-error' : '' }}">
                                {!! Form::label("settings.{$key}.{$locale}", $labels[$key].':') !!}
                                {!! Form::input('text', 'settings['.$key.']['.$locale.']', old('settings.'.$key.'.'.$locale, $portfolio->settings->{$key}->{$locale} ?? ''), ['class'=>'form-control']) !!}
                                {!! $errors->first("settings.'.$key.'.".$locale, '<span class="help-block">:message</span>') !!}
                            </div>
                        @endif
                    @endforeach
                </div>
        @endforeach
    </div>
</div>