<h4 class="sub-title"><strong>Region Setup</strong></h4>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Region</label>
    <div class="col-sm-9">
        {!! Form::text('region_name', null, ['class' => "form-control {{ $errors->has('region_name') ? ' is-invalid' : '' }}", 'placeholder'=>
        'Region Name']) !!} @if ($errors->has('region_name'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('region_name') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Regional Head</label>
    <div class="col-sm-9">
        {!! Form::select('region_head', [null => 'Select Staff as Regional Head']+$leaders, null, ['class' => "form-control {{ $errors->has('region_head')
        ? ' is-invalid' : '' }}"]) !!} @if ($errors->has('region_head'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('region_head') }}</strong>
                </span> @endif
    </div>
</div>
